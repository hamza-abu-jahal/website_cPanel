@extends('layouts.master')

@section('main_title', 'Create About Us')
@section('header_title', 'Create About Us')
@section('subheader_title', 'Create')

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">
                    {{ 'Create About Us' }}
                </span>
            </h3>
        </div>
        <div class="card-body py-3">
            <form action="{{ route('about_us.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-10">
                            <label class="form-label">
                                {{ 'Title' }}
                            </label>
                            <input type="text" name="title" class="form-control form-control-solid @error('title') is-invalid @enderror" placeholder="Title Here" value="{{ old('title') }}">
                            @error('title')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="image-input image-input-empty col-3" data-kt-image-input="true"
                         style="background-image: url({{ asset('dashboard/assets/media/avatars/blank.png') }}); margin: 15px; width: 10%; height: 10%;">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                               data-kt-image-input-action="change"
                               data-bs-toggle="tooltip"
                               data-bs-dismiss="click"
                               title="Change Main Image">
                            <i class="bi bi-pencil-fill fs-7"></i>

                            <!--begin::Inputs-->
                            <input type="file" name="main_image" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="cancel"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Cancel avatar">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="remove"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Remove avatar">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                        <!--end::Remove button-->
                    </div>
                    @error('image')
                        <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end w-md-25">Save</button>
            </form>
        </div>
    </div>

@endsection
