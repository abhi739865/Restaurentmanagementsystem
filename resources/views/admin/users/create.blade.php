
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Restaurant Management</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; margin:0; padding:30px;">

<div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px; box-shadow:0 2px 10px #ddd;">

    <h2>Add New User</h2>

    <a href="{{ route('admin.users.index') }}">← Back to Users</a>

    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px; margin:15px 0; border-radius:5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div style="margin-top:20px;">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                style="display:block; width:100%; padding:10px; margin-top:6px; box-sizing:border-box;">
        </div>

        <div style="margin-top:20px;">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                style="display:block; width:100%; padding:10px; margin-top:6px; box-sizing:border-box;">
        </div>

        <div style="margin-top:20px;">
            <label>Password</label>
            <input type="password" name="password" required
                style="display:block; width:100%; padding:10px; margin-top:6px; box-sizing:border-box;">
        </div>

        <div style="margin-top:20px;">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required
                style="display:block; width:100%; padding:10px; margin-top:6px; box-sizing:border-box;">
        </div>

        <div style="margin-top:20px;">
            <label>User Role</label>
            <select name="role" required
                style="display:block; width:100%; padding:10px; margin-top:6px; box-sizing:border-box;">
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit"
            style="margin-top:25px; padding:12px 20px; background:#2563eb; color:white; border:0; border-radius:5px; cursor:pointer;">
            Create User
        </button>
    </form>

</div>
</body>
</html>
