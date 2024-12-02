<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // 管理者を作成
        $admin = User::create([
            'name' => '米澤 容子',
            'email' => 'rinnyomu.komachi@gmail.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);

        // デフォルトユーザー作成（例: サンプル利用者）
        $user = User::create([
            'name' => 'user',
            'email' => 'user@sample.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);

        // 店舗代表者を作成
        $StoreRepresentative = User::create([
            'name' => '猪股 容子',
            'email' => 'rin.komachi.yoko@gmail.com',
            'password' => bcrypt('1111'),
            'email_verified_at' => now(),
        ]);

        // ロール作成
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $storeRepRole = Role::create(['name' => 'store-representative']);

        // 権限作成
        $manageStoresPermission = Permission::create(['name' => 'manage stores']); // 管理者権限
        $registerPermission = Permission::create(['name' => 'register']); //ユーザー権限
        $createStoresPermission = Permission::create(['name' => 'create stores']); //店舗代表者権限


        // admin 役割に権限を付与
        $adminRole->givePermissionTo([$registerPermission, $manageStoresPermission]);

        // 利用者は登録権限のみ
        $userRole->givePermissionTo($registerPermission);

        // 店舗代表者ロールに権限を付与
        $storeRepRole->givePermissionTo($createStoresPermission);

        // 管理者に admin 役割を割り当て
        $admin->assignRole($adminRole);

        // デフォルトユーザーに利用者ロールを割り当て
        $user->assignRole($userRole);

        // 店舗代表者に
        $StoreRepresentative->assignRole($storeRepRole);
    }
}
