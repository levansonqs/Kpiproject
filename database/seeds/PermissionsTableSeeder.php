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
            ['permission' => 'Private'],
            ['permission' => 'Public'],
            ['permission' => 'Protected'],
        ];
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
