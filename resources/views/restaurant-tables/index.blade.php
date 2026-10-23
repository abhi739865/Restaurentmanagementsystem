
<x-app-layout>
    <x-slot name="header">
        <div class="restaurant-header">
            <div>
                <h1>Restaurant Tables</h1>
                <p>Manage table numbers, capacity and status.</p>
            </div>

            <a class="btn add"
               href="{{ route('restaurant-tables.create') }}">
                + Add Table
            </a>
        </div>
    </x-slot>

    <style>
        .restaurant-tables-page {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
            min-height: 100%;
            color: #212529;
        }

        /* Header */
        .restaurant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            width: 100%;
        }

        .restaurant-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .restaurant-header p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        /* Table card */
        .restaurant-tables-page .card {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .restaurant-tables-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .restaurant-tables-page th,
        .restaurant-tables-page td {
            padding: 13px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .restaurant-tables-page th {
            background: #f8f9fa;
        }

        /* Buttons */
        .restaurant-tables-page .btn,
        .restaurant-header .btn {
            display: inline-block;
            padding: 9px 13px;
            border: 0;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            line-height: 1.4;
            white-space: nowrap;
        }

        .restaurant-tables-page .add,
        .restaurant-header .add {
            background: #198754;
            color: white;
        }

        .restaurant-tables-page .edit {
            background: #0d6efd;
            color: white;
        }

        .restaurant-tables-page .delete {
            background: #dc3545;
            color: white;
        }

        .restaurant-tables-page .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .restaurant-tables-page .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
        }

        /* Status */
        .restaurant-tables-page .status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .restaurant-tables-page .available {
            color: #198754;
        }

        .restaurant-tables-page .occupied {
            color: #dc3545;
        }

        .restaurant-tables-page .reserved {
            color: #b58105;
        }

        /* Actions */
        .restaurant-tables-page .actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .restaurant-tables-page .actions form {
            margin: 0;
        }

        .restaurant-tables-page .page-links {
            margin-top: 20px;
        }

        .restaurant-tables-page .other-links {
            margin-top: 20px;
        }

        .restaurant-tables-page .other-links a {
            color: #0d6efd;
            text-decoration: none;
        }

        .restaurant-tables-page .other-links a:hover {
            text-decoration: underline;
        }

        /* Mobile responsive */
        @media (max-width: 600px) {
            .restaurant-tables-page {
                padding: 12px;
            }

            .restaurant-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .restaurant-header h1 {
                font-size: 24px;
            }

            .restaurant-tables-page .card {
                padding: 12px;
            }
        }
    </style>

    <div class="restaurant-tables-page">

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                                <span class="status {{ strtolower($table->status ?? '') }}">
                                    {{ $table->status }}
                                </span>
                            </td>

                            <td>{{ $table->description ?: '-' }}</td>

                            <td>
                                <div class="actions">
                                    <a
                                        class="btn edit"
                                        href="{{ route('restaurant-tables.edit', $table) }}"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('restaurant-tables.destroy', $table) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this table?')"
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
                            <td colspan="5">
                                No restaurant tables added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="page-links">
                {{ $tables->links() }}
            </div>

            <div class="other-links">
                <a href="{{ route('categories.index') }}">Categories</a>
                |
                <a href="{{ route('menu-items.index') }}">Menu Items</a>
                |
                <a href="{{ route('dashboard') }}">Back to Dashboard</a>
            </div>
        </div>
    </div>
</x-app-layout>
