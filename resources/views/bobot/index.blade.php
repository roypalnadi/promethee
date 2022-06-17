@extends('adminlte::page')
@section('title', 'List Bobot')
@section('content_header')
    <h1 class="m-0 text-dark">List Bobot</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Alternatif</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $key => $model)
                        <tr>
                            <form action="{{route('bobot.store')}}" method="post">
                            @csrf
                                <input type="hidden" name="id" value="{{$model['id']}}">
                                <input type="hidden" name="alternatif_id" value="{{$model['alternatif_id']}}">
                                <input type="hidden" name="kriteria_id" value="{{$model['kriteria_id']}}">
                                <td>{{$key+1}}</td>
                                <td>{{$model['alternatif_nama'] ?? null}}</td>
                                <td>{{$model['kriteria_nama'] ?? null}}</td>
                                <td>
                                    <input id="nilai" type="number" name="nilai" value="{{$model['nilai']}}">
                                </td>
                                <td><button type="submit" class="btn btn-primary btn-xs">Edit</button></td>
                            </form>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <form action="" id="update-form" method="post">
        @csrf
    </form>
    <script>
        var table = $('#example2').DataTable({
            "responsive": true,
            "stateSave": true
        });

        function notificationBeforeDelete(event, el) {
            var nilai = $("#nilai").val();
            console.log(nilai);
            event.preventDefault();
            // $("#update-form").attr('action', $(el).attr('href'));
            // $("#update-form").submit();
        }
    </script>
@endpush
