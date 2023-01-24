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
            {{ 'Description' }}
        </th>
        <th>
            {{ 'Video Link' }}
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
    @if( $main_section )
        <tr class="text-center">
            <td>
                {{ $main_section->id }}
            </td>
            <td>
                {{ $main_section->title }}
            </td>
            <td>
                {{ \Illuminate\Support\Str::limit($main_section->description, 20) }}
            </td>
            <td>
                <a href="{{ $main_section->video_link }}">
                    {{ \Illuminate\Support\Str::limit($main_section->video_link, 20) }}
                </a>
            </td>
            <td>
                <img src="{{ asset('storage') . '/' . $main_section->main_image }}" alt="" width="50" height="50">
            </td>

            <td>

                <a href="{{ route('main_section.edit', ['id' => $main_section->id]) }}" class="btn btn-icon btn-light-success btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <i class="fas fa-edit fs-5"></i>
                    </span>
                </a>

                <a class="btn btn-icon btn-light-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#kt_modal_1" id="delete">
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
                        <h5 class="modal-title">Delete Main Section</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <p>
                            {{ 'You are about to be deleted Main Section, Are You Sure' }}
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('main_section.delete', ['id' => $main_section->id]) }}" method="POST">
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
