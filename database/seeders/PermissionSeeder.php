<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 🧹 احذف الكاش القديم
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ✅ أنشئ الصلاحيات
        $permissions = ['edit articles', 'delete articles', 'view reports'];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // ✅ أنشئ دور وأعطه الصلاحيات
        $role = Role::firstOrCreate(['name' => 'writer']);
        $role->syncPermissions($permissions); // يعطيه كل الصلاحيات دفعة واحدة

        // ✅ أنشئ مستخدم تجريبي
        $user = User::firstOrCreate(
            ['email' => 'writer@example.com'],
            ['name' => 'كاتب التجربة', 'password' => bcrypt('password')]
        );

        // ✅ أعطه الدور
        $user->assignRole($role);

        $this->command->info('✔️ تم إنشاء الصلاحيات والدور والمستخدم بنجاح');
    }
}
