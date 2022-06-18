@extends('adminlte::page')

@section('title', 'Edit Data Alternatif')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Alternatif</h1>
@stop

@section('content')
    <form action="{{route('alternatif.update', $model)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputName" placeholder="Nama" name="nama" value="{{$model->nama ?? old('nama')}}">
                        @error('nama') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('alternatif.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
