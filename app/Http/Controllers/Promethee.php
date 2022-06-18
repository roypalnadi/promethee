<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Bobot;
use App\Kriteria;

class Promethee extends Controller
{
    public $modelKriteria = [];
    public $modelAlternatif = [];
    public $dataPreferensi = [];
    public $dataLeavingFlow = [];
    public $dataEnteringFlow = [];
    public $dataNetFlow = [];
    public $rank = [];

    public static function proses()
    {
        $proses = new self();
        $proses->prepare();
        $proses->getPreferensi();
        $proses->getLeavingFlow();
        $proses->getEnteringFlow();
        $proses->getNetFlow();
        $proses->rank();

        return $proses;
    }

    public function prepare()
    {
        $this->modelKriteria = Kriteria::orderBy('id')->get();
        $this->modelAlternatif = Alternatif::orderBy('id')->get();
    }

    public function getPreferensi()
    {
        $dataKriteria = [];
        foreach ($this->modelAlternatif as $alternatif1) {
            $data = [];
            foreach ($this->modelAlternatif as $alternatif2) {
                $nilaiKriteria = [];
                foreach ($this->modelKriteria as $kriteria) {
                    $modelData1 = Bobot::where('alternatif_id', $alternatif1->id)
                        ->where('kriteria_id', $kriteria->id)->first();

                    $modelData2 = Bobot::where('alternatif_id', $alternatif2->id)
                        ->where('kriteria_id', $kriteria->id)->first();

                    $value = $this->preferensiFunction($modelData1->nilai ?? 0, $modelData2->nilai ?? 0);

                    $nilaiKriteria[] = $value;
                }
                $data[] = [
                    'alternatif_id_1' => $alternatif1->id ?? 0,
                    'alternatif_id_2' => $alternatif2->id ?? 0,
                    'alternatif_nama_1' => $alternatif1->nama ?? null,
                    'alternatif_nama_2' => $alternatif2->nama ?? null,
                    'kritetia_id' => $kriteria->id ?? null,
                    'kritetia_nama' => $kriteria->nama ?? null,
                    'value' => $nilaiKriteria,
                    'indeks' => $this->getIndexPreferensi($nilaiKriteria, count($nilaiKriteria)),
                ];
            }
            $dataKriteria[] = [
                'alternatif_id' => $alternatif1->id,
                'alternatif_nama' => $alternatif1->nama,
                'data' => $data,
            ];
        }

        $this->dataPreferensi = $dataKriteria;
    }

    public function getLeavingFlow()
    {
        $data = [];
        foreach ($this->dataPreferensi as $dataPreferensi) {
            $dataIndeks = collect($dataPreferensi['data'] ?? [])->pluck('indeks');
            $data[] = [
                'alternatif_id' => $dataPreferensi['alternatif_id'] ?? null,
                'alternatif_nama' => $dataPreferensi['alternatif_nama'] ?? null,
                'value' => $this->flow($dataIndeks->toArray()),
            ];
        }

        $this->dataLeavingFlow = $data;
    }

    public function getEnteringFlow()
    {
        $dataFlow = [];
        $dataPreferensi = collect($this->dataPreferensi);
        foreach ($this->modelAlternatif as $key => $alternatif1) {
            $data = [];
            $value = [];
            foreach ($this->modelAlternatif as $alternatif2) {
                $data = $dataPreferensi->where('alternatif_id', $alternatif2->id)->first();
                if ($data) {
                    $value[] = $data['data'][$key]['indeks'] ?? 0;
                } else {
                    $value[] = 0;
                }
            }
            $dataFlow[] = [
                'alternatif_id' => $alternatif1->id ?? null,
                'alternatif_nama' => $alternatif1->nama ?? null,
                'value' => $value,
            ];
        }

        $data = [];
        foreach ($dataFlow as $flow) {
            $dataIndeks = collect($flow['value'] ?? []);
            $data[] = [
                'alternatif_id' => $flow['alternatif_id'] ?? null,
                'alternatif_nama' => $flow['alternatif_nama'] ?? null,
                'value' => $this->flow($dataIndeks->toArray()),
            ];
        }

        $this->dataEnteringFlow = $data;
    }

    public function getNetFlow()
    {
        $leavingFlows = collect($this->dataLeavingFlow);
        $enteringFlows = collect($this->dataEnteringFlow);

        $data = [];
        foreach ($this->modelAlternatif as $alternatif) {
            $leavingFlow = $leavingFlows->where('alternatif_id', $alternatif->id)->first();
            $enteringFlow = $enteringFlows->where('alternatif_id', $alternatif->id)->first();

            $result = ($leavingFlow['value'] ?? 0) - ($enteringFlow['value'] ?? 0);

            $data[] = [
                'alternatif_id' => $alternatif->id ?? null,
                'alternatif_nama' => $alternatif->nama ?? null,
                'value' => $result,
            ];
        }

        $this->dataNetFlow = $data;
    }

    public function rank()
    {
        $this->rank = collect($this->dataNetFlow)->sortByDesc('value')
            ->values()
            ->map(function ($model, $key) {
                $model['rank'] = $key + 1;

                return $model;
            });
    }

    private function preferensiFunction(float $firstValue, float $secondValue)
    {
        $value = $firstValue - $secondValue;
        $result = 0;

        if ($value < 0) {
            $result = 0;
        }

        if ($value > 0) {
            $result = 1;
        }

        return $result;
    }

    private function getIndexPreferensi(array $data)
    {
        $data = collect($data);
        $total = $data->sum();
        $totalData = $data->count();
        if ($totalData) {
            return round($total / $totalData, 2);
        }

        return 0;
    }

    private function flow(array $dataIndex)
    {
        $dataIndex = collect($dataIndex);
        $divider = $dataIndex->count() - 1;
        $total = $dataIndex->sum();
        if ($divider) {
            return round($total / $divider, 2);
        }

        return 0;
    }
}
