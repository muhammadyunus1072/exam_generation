@extends('app.layouts.panel')

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
            <li class="breadcrumb-item text-muted">Permission</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->

        @can(PermissionHelper::TYPE_CREATE . ' ' . PermissionHelper::ACCESS_PERMISSION)
            <div class='row'>
                <div class="col-md-auto mt-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionModal">
                        <i class="fa fa-plus"></i>
                        Create Permission
                    </button>
                </div>
            </div>
        @endcan
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <livewire:account.permission.datatable lazy>
        </div>
    </div>
@stop
