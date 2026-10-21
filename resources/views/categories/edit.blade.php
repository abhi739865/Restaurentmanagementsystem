
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; }
        .container { max-width: 600px; margin: 35px auto; background: white; padding: 25px; border-radius: 8px; }
        label { display: block; margin: 16px 0 6px; font-weight: bold; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 11px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { display: inline-block; padding: 11px 16px; border: 0; border-radius: 5px; text-decoration: none; margin-top: 18px; cursor: pointer; }
        .save { background: #0d6efd; color: white; }
        .cancel { background: #e9ecef; color: #222; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Category</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Category Name</label>
        <input id="name" name="name" value="{{ old('name', $category->name) }}" required maxlength="255">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>

        <label for="is_active">Status</label>
        <select id="is_active" name="is_active" required>
            <option value="1" @selected(old('is_active', (string) (int) $category->is_active) == '1')>Active</option>
            <option value="0" @selected(old('is_active', (string) (int) $category->is_active) == '0')>Inactive</option>
        </select>

        <button class="btn save" type="submit">Update Category</button>
        <a class="btn cancel" href="{{ route('categories.index') }}">Cancel</a>
    </form>
</div>
</body>
</html>
