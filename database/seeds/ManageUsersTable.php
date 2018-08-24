<?php

use App\Models\ManageUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManageUsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('manage_users')->truncate();

        $userList = [
            [
                'manage_role_id'      => \App\Models\ManageRole::ROLE_ADMIN,
                'user_last_name'      => '管理',
                'user_first_name'     => '太郎',
                'email'               => 'manage@dac.co.jp',
                'password'            => 'Password1234!@',
            ],
            [
                'manage_role_id'      => \App\Models\ManageRole::ROLE_ADMIN,
                'user_last_name'      => '管理',
                'user_first_name'     => '太郎',
                'email'               => 'admin@dac.co.jp',
                'password'            => 'Password1234!@',
            ],
            [
                'manage_role_id'      => \App\Models\ManageRole::ROLE_GENERAL,
                'user_last_name'      => '一般',
                'user_first_name'     => '太郎',
                'email'               => 'general@dac.co.jp',
                'password'            => 'Password1234!@',
            ],
            [
                'manage_role_id'      => \App\Models\ManageRole::ROLE_GENERAL,
                'user_last_name'      => '一般',
                'user_first_name'     => '太郎',
                'email'               => 'general1@dac.co.jp',
                'password'            => 'Password1234!@',
            ],
        ];
        foreach ($userList as $userData){
            ManageUser::create($userData);
        }
    }
}
