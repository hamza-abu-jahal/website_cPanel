<table class="table table-row-bordered gy-5" id="blogs">
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
            {{ 'By User' }}
        </th>
        <th>
            {{ 'Status' }}
        </th>
        <th>
            {{ 'Actions' }}
        </th>
    </tr>
    </thead>
    <tbody>
    @if( $blogs )
        @foreach( $blogs as $i => $blog )
            <tr class="text-center">
                <td>
                    {{ $i += 1 }}
                </td>
                <td>
                    {{ $blog->title }}
                </td>
                <td>
                    {{ \Illuminate\Support\Str::limit($blog->description, 20) }}
                </td>

                <td>
                    {{ $blog->user->name }}
                </td>
                <td>
                    <img src="{{ asset('storage') . '/' . $blog->cover_image }}" alt="" width="50" height="50">
                </td>

                <td>
                    @if( $blog->status == 1 )
                        <button class="btn btn-success" id="status" data-id="{{ $blog->id }}">Active</button>
                    @else
                        <button class="btn btn-danger" id="status" data-id="{{ $blog->id }}">Inactive</button>
                    @endif
                </td>
                <td>
                    <a href="{{ route('blog.edit', ['id' => $blog->id]) }}" class="btn btn-icon btn-light-success btn-sm">
                        <span class="svg-icon svg-icon-3">
                            <i class="fas fa-edit fs-5"></i>
                        </span>
                    </a>

                    <a class="btn btn-icon btn-light-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#delete-{{ $blog->id }}">
                        <span class="svg-icon svg-icon-3">
                            <i class="fas fa-trash-alt fs-5"></i>
                        </span>
                    </a>
                </td>
            </tr>

            {{-- Delete Modal --}}
            <div class="modal fade" tabindex="-1" id="delete-{{ $blog->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Blog</h5>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-2x"></span>
                            </div>
                            <!--end::Close-->
                        </div>

                        <div class="modal-body">
                            <p>
                                {{ 'You are about to be deleted Blog, Are You Sure ?' }}
                            </p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('blog.delete', ['id' => $blog->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-primary delete-icon" data-id="{{ $blog->id }}">
                                    Sure
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    </tbody>
</table>

