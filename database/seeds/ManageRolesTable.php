<?php

use App\Models\ManageRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManageRolesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('manage_roles')->truncate();
        ManageRole::insert(
            [
                [
                    'id'                  => ManageRole::ROLE_ADMIN,
                    'role_name'           => ManageRole::$roleNames[ManageRole::ROLE_ADMIN],
                ],
                [
                    'id'                  => ManageRole::ROLE_GENERAL,
                    'role_name'           => ManageRole::$roleNames[ManageRole::ROLE_GENERAL],
                ]
            ]
        );
    }
}
