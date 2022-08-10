@extends('adminlte::page')

@section('title', 'Edit Data Kriteria')

@section('content_header')
    <h1 class="m-0 text-dark">Pilihan Data Kriteria</h1>
@stop

@section('content')
    <form action="{{route('kriteria.updatePilihan', $model)}}" method="post">
        @method('POST')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputName" placeholder="Nama" name="nama" value="{{$model->nama ?? old('nama')}}" readonly>
                        @error('nama') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div id="insert-form">
                        @foreach ($modelPilihan as $pilihan)
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputName">Pilihan</label>
                                <input type="text" class="form-control @error('pilihan') is-invalid @enderror" id="exampleInputName" placeholder="Pilihan" name="pilihan[]" value="{{$pilihan->nama ?? old('pilihan')}}" required>
                                @error('pilihan') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputName">Nilai</label>
                                <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="exampleInputName" placeholder="Nilai" name="nilai[]" value="{{$pilihan->nilai ?? old('pilihan')}}" required>
                                @error('pilihan') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="button" id="btn-tambah-form" class="btn btn-block btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Tambah Pilihan</button>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btn-reset-form" class="btn btn-block btn-outline-danger btn-sm"><i class="fa fa-minus"></i> Hapus Pilihan</button>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('kriteria.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>

    $(document).ready(function(){ // Ketika halaman sudah diload dan siap
        $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
        var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
        var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya

        // Kita akan menambahkan form dengan menggunakan append
        // pada sebuah tag div yg kita beri id insert-form
        $("#insert-form").append(
            "<div class='row'>" +
                "<div class='form-group col-6'>" +
                    "<label for='exampleInputName'>Pilihan</label>" +
                    "<input type='text' class='form-control @error('pilihan') is-invalid @enderror' id='exampleInputName' placeholder='Pilihan' name='pilihan[]' required>" +
                    "@error('pilihan') <span class='text-danger'>{{$message}}</span> @enderror" +
                "</div>" +
                "<div class='form-group col-6'>" +
                    "<label for='exampleInputName'>Nilai</label>" +
                    "<input type='text' class='form-control @error('nilai') is-invalid @enderror' id='exampleInputName' placeholder='Nilai' name='nilai[]' required>" +
                    "@error('pilihan') <span class='text-danger'>{{$message}}</span> @enderror" +
                "</div>" +
            "</div>"
            );

        });

        // Buat fungsi untuk mereset form ke semula
        $("#btn-reset-form").click(function(){
        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
        });
    });
</script>
@stop
