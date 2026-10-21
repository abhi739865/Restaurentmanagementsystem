
<div class="mb-3">
    <label class="form-label">Blog Title</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $blog?->title) }}" required>
    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Short Description</label>
    <textarea name="short_description" class="form-control"
              rows="3">{{ old('short_description', $blog?->short_description) }}</textarea>
    @error('short_description') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Full Content</label>
    <textarea name="content" class="form-control" rows="8"
              required>{{ old('content', $blog?->content) }}</textarea>
    @error('content') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Blog Image</label>
    <input type="file" name="image" class="form-control"
           accept=".jpg,.jpeg,.png,.webp">
    <small class="text-muted">Maximum image size: 2 MB.</small>
    @error('image') <div class="text-danger">{{ $message }}</div> @enderror

    @if($blog?->image)
        <img src="{{ asset('storage/'.$blog->image) }}"
             width="150" class="mt-2" alt="Current blog image">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Publication Status</label>
    <select name="is_published" class="form-select" required>
        <option value="0"
            {{ (string) old('is_published', $blog?->is_published ? '1' : '0') === '0' ? 'selected' : '' }}>
            Draft
        </option>
        <option value="1"
            {{ (string) old('is_published', $blog?->is_published ? '1' : '0') === '1' ? 'selected' : '' }}>
            Published
        </option>
    </select>
</div>

<button type="submit" class="btn btn-primary">Save Blog</button>
<a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
