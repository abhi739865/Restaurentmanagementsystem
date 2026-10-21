
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:24px;font-weight:bold;color:#111827;">
            User Management
        </h2>
    </x-slot>

    <div style="max-width:1100px;margin:30px auto;padding:20px;">

        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:24px;">
            <div>
                <h3 style="font-size:22px;font-weight:bold;">All Users</h3>
                <p style="color:#6b7280;">Manage restaurant admin and staff accounts.</p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               style="background:#2563eb;color:white;padding:12px 18px;border-radius:6px;text-decoration:none;">
                + Add User
            </a>
        </div>

        @if (session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:6px;margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:6px;margin-bottom:16px;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:6px;margin-bottom:16px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f3f4f6;text-align:left;">
                        <th style="padding:14px;">ID</th>
                        <th style="padding:14px;">Name</th>
                        <th style="padding:14px;">Email</th>
                        <th style="padding:14px;">Role</th>
                        <th style="padding:14px;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                {{ $user->id }}
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                {{ $user->name }}
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                {{ $user->email }}
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                <span style="display:inline-block;padding:5px 10px;border-radius:20px;background:{{ $user->role === 'admin' ? '#dbeafe' : '#f3f4f6' }};color:{{ $user->role === 'admin' ? '#1d4ed8' : '#374151' }};">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                @if ($user->id !== auth()->id())
                                    <form method="POST"
                                          action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                style="background:#dc2626;color:white;padding:8px 12px;border:0;border-radius:5px;cursor:pointer;">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span style="color:#6b7280;">Current user</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:20px;text-align:center;">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $users->links() }}
        </div>

        <div style="margin-top:20px;">
            <a href="{{ route('admin.dashboard') }}"
               style="color:#2563eb;text-decoration:none;">
                ← Back to Admin Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
