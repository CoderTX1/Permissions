<!-- resources/views/permissions/index.blade.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الصلاحيات</title>
    <style>
        body { font-family: 'Tajawal', sans-serif; direction: rtl; margin: 30px; }
        input, button { padding: 5px; margin: 5px; }
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: right; }
    </style>
</head>
<body>

<h2>إدارة الصلاحيات</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('permissions.store') }}">
    @csrf
    <input type="text" name="name" placeholder="اسم الصلاحية" required>
    <button type="submit">إضافة</button>
</form>

<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>إجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>
            @can('delete permission')
    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('هل أنت متأكد؟')">حذف</button>
    </form>
@endcan

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
