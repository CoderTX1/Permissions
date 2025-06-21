<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="p-6">
        <h3>مرحبًا {{ auth()->user()->name }}</h3>

        <h4 class="mt-4">الصلاحيات الفعلية:</h4>
        <ul class="list-disc list-inside">
            @foreach(auth()->user()->getAllPermissions() as $permission)
                <li>🔐 {{ $permission->name }}</li>
            @endforeach
        </ul>


        @if (session('active_role') === 'writer')
    <p>أنت داخل كـ كاتب ✏️</p>
@endif
 
        <hr class="my-4">

        <h4>القائمة الخاصة بك:</h4>
        <ul class="list-disc list-inside">
            @can('edit articles')
                <li>✏️ تعديل المقالات</li>
            @endcan

            @can('delete articles')
                <li>🗑️ حذف المقالات</li>
            @endcan

            @can('view reports')
                <li>📊 عرض التقارير</li>
            @endcan
        </ul>
    </div>
</x-app-layout>
