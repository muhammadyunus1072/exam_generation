@extends('layouts.index')

@section('title', 'Master Data User')

@section('header')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Master Data</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Admin</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Role And Permission</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@stop
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