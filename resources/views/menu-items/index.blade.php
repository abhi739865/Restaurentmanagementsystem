
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2>Restaurant Menu</h2>
            <p>Manage your food items</p>
        </div>
    </x-slot>

    <style>
        .menu-page {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #222;
            padding: 20px;
            border-radius: 8px;
        }

        .menu-page .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        .menu-page .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .menu-page .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            font-size: 14px;
        }

        .menu-page .primary {
            background: #198754;
            color: white;
        }

        .menu-page .edit {
            background: #0d6efd;
            color: white;
        }

        .menu-page .delete {
            background: #dc3545;
            color: white;
        }

        .menu-page .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            overflow-x: auto;
        }

        .menu-page table {
            width: 100%;
            border-collapse: collapse;
        }

        .menu-page th,
        .menu-page td {
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #eee;
        }

        .menu-page th {
            background: #f8f9fa;
        }

        .menu-page img {
            width: 60px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .menu-page .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
        }

        .menu-page .badge {
            padding: 5px 8px;
            border-radius: 4px;
            background: #d1e7dd;
            color: #0f5132;
        }

        .menu-page .unavailable {
            background: #f8d7da;
            color: #842029;
        }

        .menu-page .actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        @media (max-width: 650px) {
            .menu-page .header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="menu-page">
        <div class="container">
            <div class="header">
                <div>
                    <h1>Restaurant Menu</h1>
                    <p>Manage your food items</p>
                </div>

                <a class="btn primary" href="{{ route('menu-items.create') }}">
                    + Add Food Item
                </a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($menuItems as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                        <img
                                            src="{{ asset('storage/'.$item->image) }}"
                                            alt="{{ $item->name }}"
                                        >
                                    @else
                                        No image
                                    @endif
                                </td>

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>₹{{ number_format((float) $item->price, 2) }}</td>

                                <td>
                                    <span class="badge {{ $item->is_available ? '' : 'unavailable' }}">
                                        {{ $item->is_available ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            class="btn edit"
                                            href="{{ route('menu-items.edit', $item) }}"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('menu-items.destroy', $item) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this food item?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn delete" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    No food items yet. Click Add Food Item to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div style="margin-top:20px">
                    {{ $menuItems->links() }}
                </div>
            </div>

            <div style="margin-top:20px; padding-bottom:20px">
                <a
                    href="{{ route('dashboard') }}"
                    style="display:inline-block;background:#16a34a;color:white;padding:10px 16px;border-radius:6px;text-decoration:none"
                >
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
