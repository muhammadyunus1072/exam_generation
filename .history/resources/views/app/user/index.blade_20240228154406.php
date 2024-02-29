@extends('layouts.index')

@section('title', 'Master Data User')

@section('content')
    <div class="card">
        <div class="card-header">
            @livewire('laporan.laporan-kpknl.filter')
        </div>
        <div class="card-body">
            @livewire('laporan.laporan-kpknl.datatable')
        </div>
    </div>
@stop