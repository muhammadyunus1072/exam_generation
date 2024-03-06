@extends('layouts.index')

@section('title', 'Master Data User')

@section('content')
    <div class="card">
        <div class="card-header">
            @livewire('user.filter')
        </div>
        <div class="card-body">
            @livewire('user.datatable')
        </div>
    </div>
@stop