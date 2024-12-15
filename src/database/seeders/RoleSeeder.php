<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 権限作成
        $manageStoresPermission = Permission::create(['name' => 'manage stores']);
        $registerPermission = Permission::create(['name' => 'register']);
        $createStoresPermission = Permission::create(['name' => 'create stores']);

        // ロール作成
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $storeRepRole = Role::create(['name' => 'store-representative']);

        // 権限付与
        $adminRole->givePermissionTo([$registerPermission, $manageStoresPermission]);
        $userRole->givePermissionTo($registerPermission);
        $storeRepRole->givePermissionTo($createStoresPermission);

        // ユーザー作成
        $admin = User::create([
            'name' => '米澤 容子',
            'email' => 'rinnyomu.komachi@gmail.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@sample.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);
        $storeRepresentative = User::create([
            'name' => '猪股 容子',
            'email' => 'rin.komachi.yoko@gmail.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);

        // ロール割り当て
        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
        $storeRepresentative->assignRole($storeRepRole);
    }
}
