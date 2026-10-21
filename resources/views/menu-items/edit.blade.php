
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Food Item</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; }
        .container { max-width: 650px; margin: 35px auto; padding: 25px; background: white; border-radius: 8px; }
        label { display: block; margin: 15px 0 6px; font-weight: bold; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 11px; border: 1px solid #ccc; border-radius: 5px; }
        img { width: 100px; display: block; margin-top: 10px; }
        .btn { display: inline-block; padding: 11px 16px; border: 0; border-radius: 5px; text-decoration: none; cursor: pointer; margin-top: 18px; }
        .primary { background: #0d6efd; color: white; }
        .secondary { background: #e9ecef; color: #222; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Food Item</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('menu-items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Food Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $menuItem->name) }}" required>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $menuItem->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3">{{ old('description', $menuItem->description) }}</textarea>

        <label for="price">Price (₹)</label>
        <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price', $menuItem->price) }}" required>

        <label for="image">Replace Food Image (optional, max 2 MB)</label>
        <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/*">

        @if($menuItem->image)
            <p>Current image:</p>
            <img src="{{ asset('storage/'.$menuItem->image) }}" alt="{{ $menuItem->name }}">
        @endif

        <label for="is_available">Availability</label>
        <select id="is_available" name="is_available" required>
            <option value="1" @selected(old('is_available', (string) (int) $menuItem->is_available) == '1')>Available</option>
            <option value="0" @selected(old('is_available', (string) (int) $menuItem->is_available) == '0')>Unavailable</option>
        </select>

        <button class="btn primary" type="submit">Update Food Item</button>
        <a class="btn secondary" href="{{ route('menu-items.index') }}">Cancel</a>
    </form>
</div>
</body>
</html>
