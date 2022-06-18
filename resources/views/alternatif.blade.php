@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Alernatif</h1>
<p>Masukan data alternatif yang diinginkan untuk dicari peluang terpilih</p>
@stop

@section('content')
<x-adminlte-modal id="modalCustom" title="Buat Baru" size="lg" theme="teal"
    icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div style="height:800px;">Read the account policies...</div>
    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="success" label="Accept"/>
        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>
{{-- Example button to open modal --}}
<x-adminlte-button icon="fas fa-plus" label="Buat Baru" data-toggle="modal" data-target="#modalCustom" class="bg-teal"/>
<hr>
<x-adminlte-datatable id="table8" :heads="$heads" :config="$config" theme="light" striped hoverable/>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
