<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('permissions')) {
            DB::table('permissions')->truncate();
        }
        $permissions = [
            ['permission' => 'Private'],//riêng tư
            ['permission' => 'Public'],// công khai
            ['permission' => 'Protected'], //chir trong nhóm nhìn thấy
        ];
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
