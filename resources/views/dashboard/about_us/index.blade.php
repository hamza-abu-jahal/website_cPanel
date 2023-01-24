@extends('layouts.master')

@section('css')
    <link href="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('main_title', 'About Us')
@section('header_title', 'About Us')
@section('subheader_title', 'Index')

@section('content')
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ 'About Us' }}
                </span>
                <span class="text-muted fw-bold fs-7">
                    {{ 'There Is'}} {{ $about_us ? $about_us->count() : '0' }} {{ 'About Us' }}
                </span>
            </h3>
            <!--end::Title-->

            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                 title="{{ $about_us ?  'There Is About Us Already' : 'Click To Add New About Us' }}"
                 disabled>

                <a href="{{ route('about_us.create') }}"
                   class="btn btn-sm btn-light-primary  @if($about_us) disabled @endif">
                    <span class="svg-icon svg-icon-3">
                        <i class="fas fa-plus-square fs-3"></i>
                    </span>
                    Create About Us
                </a>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive" id="table-data">
                <table class="table table-row-bordered gy-5" id="contact-us">
                    <thead>
                    <tr class="fw-bold fs-6 text-muted text-center">
                        <th>
                            #
                        </th>
                        <th>
                            {{ 'Title' }}
                        </th>
                        <th>
                            {{ 'Main Image' }}
                        </th>
                        <th>
                            {{ 'Actions' }}
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @if( $about_us )
                        <tr class="text-center">
                            <td>
                                {{ $about_us->id }}
                            </td>
                            <td>
                                {{ $about_us->title }}
                            </td>
                            <td>
                                <img src="{{ asset('storage') . '/' . $about_us->main_image }}" alt="" width="50"
                                     height="50">
                            </td>

                            <td>

                                <a href="{{ route('about_us.edit', ['id' => $about_us->id]) }}"
                                   class="btn btn-icon btn-light-success btn-sm">
                                    <span class="svg-icon svg-icon-3">
                                        <i class="fas fa-edit fs-5"></i>
                                    </span>
                                </a>

                                <a class="btn btn-icon btn-light-danger btn-sm" data-bs-toggle="modal"
                                   data-bs-target="#kt_modal_1" id="delete">
                                    <span class="svg-icon svg-icon-3">
                                        <i class="fas fa-trash-alt fs-5"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>

                        {{-- Delete Modal --}}
                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete About Us</h5>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                             data-bs-dismiss="modal" aria-label="Close">
                                            <span class="svg-icon svg-icon-2x"></span>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <p>
                                            {{ 'You are about to be deleted About Us, Are You Sure' }}
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                        </button>
                                        <form action="{{ route('about_us.delete', ['id' => $about_us->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-primary">
                                                Sure
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    </tbody>
                </table>

            </div>
            <!--end::Body-->
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection


