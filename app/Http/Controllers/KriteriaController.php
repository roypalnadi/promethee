<?php

namespace App\Http\Controllers;

use App\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();

        return view('kriteria.index', [
            'models' => $kriteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $array = $request->only([
            'nama',
        ]);
        $model = Kriteria::create($array);

        return redirect()->route('kriteria.index')
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
        $kriteria = Kriteria::find($id);
        if (!$kriteria) {
            return redirect()->route('kriteria.index')
                ->with('error_message', 'Kriteria dengan id'.$id.' tidak ditemukan');
        }

        return view('kriteria.edit', [
            'model' => $kriteria,
        ]);
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
        $request->validate([
            'nama' => 'required',
        ]);
        $data = Kriteria::find($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('kriteria.index')
            ->with('success_message', 'Berhasil mengubah data');
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
        $data = Kriteria::find($id);
        if ($data) {
            $data->delete();
        }

        return redirect()->route('kriteria.index')
            ->with('success_message', 'Berhasil menghapus data');
    }
}
