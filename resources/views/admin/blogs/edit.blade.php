
@extends('layouts.blog')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Restaurant Blog</h2>

    <form action="{{ route('admin.blogs.update', $blog) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blogs._form', ['blog' => $blog])
    </form>
</div>
@endsection
