
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Restaurant Table</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; }
        .container { max-width: 600px; margin: 35px auto; background: white; padding: 25px; border-radius: 8px; }
        label { display: block; margin: 16px 0 6px; font-weight: bold; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 11px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { display: inline-block; padding: 11px 16px; border: 0; border-radius: 5px; text-decoration: none; margin-top: 18px; cursor: pointer; }
        .save { background: #198754; color: white; }
        .cancel { background: #e9ecef; color: #222; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <h1>Add Restaurant Table</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('restaurant-tables.store') }}" method="POST">
        @csrf

        <label for="table_number">Table Number</label>
        <input id="table_number" name="table_number" value="{{ old('table_number') }}" required placeholder="e.g. T01">

        <label for="capacity">Seating Capacity</label>
        <input id="capacity" type="number" name="capacity" min="1" max="100" value="{{ old('capacity', 4) }}" required>

        <label for="status">Status</label>
        <select id="status" name="status" required>
            @foreach(['available' => 'Available', 'occupied' => 'Occupied', 'reserved' => 'Reserved'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', 'available') === $value)>{{ $label }}</option>
            @endforeach
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

        <button class="btn save" type="submit">Save Table</button>
        <a class="btn cancel" href="{{ route('restaurant-tables.index') }}">Cancel</a>
    </form>
</div>
</body>
</html>
