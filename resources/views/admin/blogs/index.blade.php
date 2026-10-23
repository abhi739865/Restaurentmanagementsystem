
<x-app-layout>
    <x-slot name="header">
        <div class="blog-admin-header">
            <h2>Blog Management</h2>

            <a href="{{ route('admin.blogs.create') }}"
               class="blog-btn blog-btn-primary">
                + Add New Blog
            </a>
        </div>
    </x-slot>

    <style>
        .blog-admin-page {
            background: #f4f6f9;
            padding: 24px;
            min-height: 100%;
            font-family: Arial, sans-serif;
            color: #212529;
        }

        .blog-admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            width: 100%;
        }

        .blog-admin-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .blog-admin-page .blog-alert {
            padding: 13px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .blog-admin-page .blog-alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .blog-admin-page .blog-table-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow-x: auto;
        }

        .blog-admin-page .blog-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .blog-admin-page .blog-table th {
            background: #29231f;
            color: #fff;
            font-weight: 600;
            text-align: left;
            padding: 15px;
            white-space: nowrap;
        }

        .blog-admin-page .blog-table td {
            padding: 14px 15px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
            text-align: left;
        }

        .blog-admin-page .blog-table tbody tr:hover {
            background: #fafafa;
        }

        .blog-admin-page .blog-image {
            width: 90px;
            height: 65px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
        }

        .blog-admin-page .blog-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .blog-admin-page .blog-published {
            background: #d1e7dd;
            color: #0f5132;
        }

        .blog-admin-page .blog-draft {
            background: #fff3cd;
            color: #856404;
        }

        .blog-admin-page .blog-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .blog-admin-page .blog-actions form {
            margin: 0;
        }

        .blog-admin-page .blog-btn {
            display: inline-block;
            border: 0;
            border-radius: 5px;
            padding: 9px 13px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            line-height: 1.4;
            white-space: nowrap;
        }

        .blog-admin-page .blog-btn-primary,
        .blog-admin-header .blog-btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .blog-admin-page .blog-btn-primary:hover,
        .blog-admin-header .blog-btn-primary:hover {
            background: #1d4ed8;
        }

        .blog-admin-page .blog-btn-edit {
            background: #f59e0b;
            color: #fff;
        }

        .blog-admin-page .blog-btn-edit:hover {
            background: #d97706;
        }

        .blog-admin-page .blog-btn-delete {
            background: #dc3545;
            color: #fff;
        }

        .blog-admin-page .blog-btn-delete:hover {
            background: #bb2d3b;
        }

        .blog-admin-page .blog-empty {
            text-align: center;
            padding: 45px 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .blog-admin-page .blog-empty h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .blog-admin-page .blog-empty p {
            color: #6b7280;
            margin: 0;
        }

        .blog-admin-page .blog-pagination {
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .blog-admin-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .blog-admin-page {
                padding: 14px;
            }

            .blog-admin-header h2 {
                font-size: 21px;
            }
        }
    </style>

    <div class="blog-admin-page">

        @if(session('success'))
            <div class="blog-alert blog-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($blogs->count())
            <div class="blog-table-card">
                <table class="blog-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->image)
                                        <img
                                            src="{{ asset('storage/' . $blog->image) }}"
                                            class="blog-image"
                                            alt="{{ $blog->title }}"
                                        >
                                    @else
                                        <span>No image</span>
                                    @endif
                                </td>

                                <td>{{ $blog->title }}</td>

                                <td>
                                    @if($blog->is_published)
                                        <span class="blog-status blog-published">
                                            Published
                                        </span>
                                    @else
                                        <span class="blog-status blog-draft">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="blog-actions">
                                        <a
                                            href="{{ route('admin.blogs.edit', $blog) }}"
                                            class="blog-btn blog-btn-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.blogs.destroy', $blog) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this blog?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="blog-btn blog-btn-delete"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="blog-empty">
                <h3>No blogs added yet.</h3>
                <p>Click "Add New Blog" to create your first blog.</p>
            </div>
        @endif

        <div class="blog-pagination">
            {{ $blogs->links() }}
        </div>

    </div>
</x-app-layout>
