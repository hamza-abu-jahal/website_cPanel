@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('main_title', 'Main Section')
@section('header_title', 'Main Section')
@section('subheader_title', 'Index')

@section('content')
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ 'Main Section' }}
                </span>
                <span class="text-muted fw-bold fs-7">
                    {{ 'There Is'}} {{ $main_section ? $main_section->count() : '0' }} {{ 'Main Section' }}
                </span>
            </h3>
            <!--end::Title-->

            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                 title="{{$main_section ?  'There Is Main Section Already' : 'Click To Add New Main Section' }}" disabled>

                <a href="{{ route('main_section.create') }}" class="btn btn-sm btn-light-primary  @if($main_section) disabled @endif">
                    <span class="svg-icon svg-icon-3">
                        <i class="fas fa-plus-square fs-3"></i>
                    </span>
                    Create Main Section
                </a>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive" id="table-data">
                @include('dashboard.main_section.table-data')
            </div>
            <!--end::Body-->
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection


