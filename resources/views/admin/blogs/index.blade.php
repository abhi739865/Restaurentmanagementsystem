@extends('layouts.blog')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Blog Management</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            + Add New Blog
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/'.$blog->image) }}"
                                     width="90" height="65"
                                     style="object-fit: cover" alt="Blog image">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.blogs.destroy', $blog) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this blog?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No blogs added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $blogs->links() }}
</div>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
