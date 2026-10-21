
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories - Restaurant Management</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; }
        .container { max-width: 1000px; margin: 35px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .card { background: white; padding: 20px; margin-top: 20px; border-radius: 8px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; }
        .btn { display: inline-block; padding: 9px 13px; border: 0; border-radius: 5px; text-decoration: none; cursor: pointer; }
        .add { background: #198754; color: white; }
        .edit { background: #0d6efd; color: white; }
        .delete { background: #dc3545; color: white; }
        .success { background: #d1e7dd; padding: 12px; border-radius: 5px; }
        .error { background: #f8d7da; padding: 12px; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Food Categories</h1>
            <p>Manage restaurant categories</p>
        </div>
        <a class="btn add" href="{{ route('categories.create') }}">+ Add Category</a>
    </div>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Menu Items</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?: '-' }}</td>
                    <td>{{ $category->menu_items_count }}</td>
                    <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a class="btn edit" href="{{ route('categories.edit', $category) }}">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST" style="display:inline"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No categories created yet.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">{{ $categories->links() }}</div>
        <p><a href="{{ route('menu-items.index') }}">Go to Menu Items</a></p>
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
