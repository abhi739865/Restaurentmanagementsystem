
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Food Item</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; }
        .container { max-width: 650px; margin: 35px auto; padding: 25px; background: white; border-radius: 8px; }
        label { display: block; margin: 15px 0 6px; font-weight: bold; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 11px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { display: inline-block; padding: 11px 16px; border: 0; border-radius: 5px; text-decoration: none; cursor: pointer; margin-top: 18px; }
        .primary { background: #198754; color: white; }
        .secondary { background: #e9ecef; color: #222; }
        .error { color: #dc3545; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Add Food Item</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if($categories->isEmpty())
        <p>No active categories found. Please create a category before adding food items.</p>
        <a class="btn secondary" href="{{ route('dashboard') }}">Back to Dashboard</a>
    @else
        <form action="{{ route('menu-items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Food Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>

            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

            <label for="price">Price (₹)</label>
            <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required>

            <label for="image">Food Image (max 2 MB)</label>
            <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/*">

            <label for="is_available">Availability</label>
            <select id="is_available" name="is_available" required>
                <option value="1" @selected(old('is_available', '1') == '1')>Available</option>
                <option value="0" @selected(old('is_available') === '0')>Unavailable</option>
            </select>

            <button class="btn primary" type="submit">Save Food Item</button>
            <a class="btn secondary" href="{{ route('menu-items.index') }}">Cancel</a>
        </form>
    @endif
</div>
</body>
</html>
