<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة مستخدم</title>
    <style>
        body { font-family: 'Tajawal', sans-serif; direction: rtl; padding: 20px; }
        label { display: block; margin: 10px 0 5px; }
        input, select { padding: 5px; width: 300px; }
    </style>
</head>
<body>

<h2>إضافة مستخدم جديد</h2>

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <label>الاسم</label>
    <input type="text" name="name" required>

    <label>الإيميل</label>
    <input type="email" name="email" required>

    <label>كلمة المرور</label>
    <input type="password" name="password" required>

    <label>الصلاحيات</label>
    <select name="permissions[]" multiple required>
        @foreach($permissions as $permission)
            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
        @endforeach
    </select>

    <br><br>
    <button type="submit">إنشاء</button>
</form>

</body>
</html>
