
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Tables</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; }
        .container { max-width: 1000px; margin: 35px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
        .card { background: white; padding: 20px; margin-top: 20px; border-radius: 8px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; }
        .btn { display: inline-block; padding: 9px 13px; border: 0; border-radius: 5px; text-decoration: none; cursor: pointer; }
        .add { background: #198754; color: white; }
        .edit { background: #0d6efd; color: white; }
        .delete { background: #dc3545; color: white; }
        .success { background: #d1e7dd; padding: 12px; border-radius: 5px; }
        .status { font-weight: bold; text-transform: capitalize; }
        .available { color: #198754; }
        .occupied { color: #dc3545; }
        .reserved { color: #b58105; }
        .actions { display: flex; gap: 6px; align-items: center; }
        @media(max-width: 600px) { .header { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Restaurant Tables</h1>
            <p>Manage table numbers, capacity and status.</p>
        </div>
        <a class="btn add" href="{{ route('restaurant-tables.create') }}">+ Add Table</a>
    </div>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="success">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Table No.</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tables as $table)
                <tr>
                    <td>{{ $table->table_number }}</td>
                    <td>{{ $table->capacity }} people</td>
                    <td>
                        <span class="status {{ $table->status }}">
                            {{ $table->status }}
                        </span>
                    </td>
                    <td>{{ $table->description ?: '-' }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn edit" href="{{ route('restaurant-tables.edit', $table) }}">Edit</a>
                            <form action="{{ route('restaurant-tables.destroy', $table) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this table?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No restaurant tables added yet.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">{{ $tables->links() }}</div>
        <p><a href="{{ route('categories.index') }}">Categories</a> | <a href="{{ route('menu-items.index') }}">Menu Items</a></p>
    </div>
    
<div style="margin-top: 20px; padding: 0 0 20px;">
    <a href="{{ route('dashboard') }}"
       style="display: inline-block; background: #16a34a; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
        ← Back to Dashboard
    </a>
</div>

</div>
</body>
</html>
