@extends('adminlte::page')
@section('title', 'List Bobot')
@section('content_header')
    <h1 class="m-0 text-dark">List Bobot</h1>
@stop
@section('content')
{{-- collect($dataPreferensi)->pluck('data')->collapse() --}}
<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Nilai Indeks Preferensi</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-stripped" id="example2">
            <thead>
            <tr>
                <th></th>
                @foreach ($modelAlternatif as $alternatif)
                    <th>{{$alternatif['nama'] ?? null}}</th>
                @endforeach
            </tr>
            </thead>
                @foreach ($dataPreferensi as $item)
                <tr>
                    <th>{{$item['alternatif_nama'] ?? null}}</th>
                    @foreach ($item['data'] ?? [] as $data)
                        <td>{{$data['indeks']}}</td>
                    @endforeach
                </tr>
                @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Nilai Leaving Flow</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-stripped" id="example2">
            <thead>
            <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
            </tr>
            </thead>
                @foreach ($dataLeavingFlow as $item)
                <tr>
                    <td>{{$item['alternatif_nama'] ?? null}}</td>
                    <td>{{$item['value'] ?? null}}</td>
                </tr>
                @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Nilai Entering Flow</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-stripped" id="example2">
            <thead>
            <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
            </tr>
            </thead>
                @foreach ($dataEnteringFlow as $item)
                <tr>
                    <td>{{$item['alternatif_nama'] ?? null}}</td>
                    <td>{{$item['value'] ?? null}}</td>
                </tr>
                @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Nilai Net Flow</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-stripped" id="example2">
            <thead>
            <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
            </tr>
            </thead>
                @foreach ($dataNetFlow as $item)
                <tr>
                    <td>{{$item['alternatif_nama'] ?? null}}</td>
                    <td>{{$item['value'] ?? null}}</td>
                </tr>
                @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ranking</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-stripped" id="example2">
            <thead>
            <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
                <th>Ranking</th>
            </tr>
            </thead>
                @foreach ($rank as $item)
                <tr>
                    <td>{{$item['alternatif_nama'] ?? null}}</td>
                    <td>{{$item['value'] ?? null}}</td>
                    <td>{{$item['rank'] ?? null}}</td>
                </tr>
                @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
