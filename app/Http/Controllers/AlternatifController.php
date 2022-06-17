<?php

namespace App\Http\Controllers;

use App\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatif = Alternatif::all();

        return view('alternatif.index', [
            'models' => $alternatif,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.create');
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
        $model = Alternatif::create($array);

        return redirect()->route('alternatif.index')
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
        $alternatif = Alternatif::find($id);
        if (!$alternatif) {
            return redirect()->route('alternatif.index')
                ->with('error_message', 'Alternatif dengan id'.$id.' tidak ditemukan');
        }

        return view('alternatif.edit', [
            'model' => $alternatif,
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
        $data = Alternatif::find($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('alternatif.index')
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
        $data = Alternatif::find($id);
        if ($data) {
            $data->delete();
        }

        return redirect()->route('alternatif.index')
            ->with('success_message', 'Berhasil menghapus data');
    }
}
