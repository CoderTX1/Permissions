<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة المستخدمين</title>
    <style>
        body { font-family: 'Tajawal', sans-serif; direction: rtl; padding: 20px; }
        table { border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: right; }
    </style>
</head>
<body>

<h2>المستخدمين</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@can('create user')
    <a href="{{ route('users.create') }}">➕ إضافة مستخدم جديد</a>
@endcan


<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>الإيميل</th>
            <th>الصلاحيات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($user->permissions as $permission)
                    <span>{{ $permission->name }}</span>{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
