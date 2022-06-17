<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Bobot;
use App\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelAlternatif = Alternatif::all();
        $modelKriteria = Kriteria::all();
        $modelBobot = Bobot::all();

        $data = [];
        foreach ($modelAlternatif as $alternatif) {
            foreach ($modelKriteria as $kriteria) {
                $bobot = $modelBobot->where('alternatif_id', $alternatif->id)
                    ->where('kriteria_id', $kriteria->id)->first();
                $data[] = [
                    'alternatif_nama' => $alternatif->nama,
                    'alternatif_id' => $alternatif->id,
                    'kriteria_nama' => $kriteria->nama,
                    'kriteria_id' => $kriteria->id,
                    'nilai' => $bobot->nilai ?? 0,
                    'id' => $bobot->id ?? null,
                ];
            }
        }

        return view('bobot.index', [
            'models' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $model = Bobot::find($request->id);
            if (!$model) {
                return redirect()->route('bobot.index')
                    ->with('error_message', 'Kriteria dengan id'.$request->id.' tidak ditemukan');
            }

            $model->nilai = $request->nilai;
            $model->save();
        } else {
            $model = Bobot::create($request->all());
        }

        return redirect()->route('bobot.index')
            ->with('success_message', 'Berhasil menambah data baru');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
