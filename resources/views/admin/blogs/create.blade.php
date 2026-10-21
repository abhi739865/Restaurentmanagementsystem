
@extends('layouts.blog')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create Restaurant Blog</h2>

    <form action="{{ route('admin.blogs.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blogs._form', ['blog' => null])
    </form>
</div>
@endsection
