<?php

namespace App\Http\Controllers;

use App\Alternatif;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data = Promethee::proses();

        return view('home');
    }

    public function alternatif()
    {
        $models = Alternatif::get()
            ->transform(function ($model, $key) {
                return [
                    $key + 1,
                    $model->nama,
                    '<nobr>
                    <a href="https://www.nesabamedia.com" target="_blank">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </a>
                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                    </nobr>',
                ];
            });

        $heads = [
            'No',
            ['label' => 'Nama', 'width' => 70],
            'Actions',
        ];

        $config = [
            'data' => $models->toArray(),
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
        ];

        return view('alternatif', compact('heads', 'config'));
    }

    public function kriteria()
    {
        return view('kriteria');
    }

    public function proses()
    {
        return view('kriteria');
    }
}
