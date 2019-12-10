<?php

use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_balance')->insert([
            'user_id'           => 1,
            'balance'           => 0,
            'balance_archive'   => 0,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        DB::table('user_balance')->insert([
            'user_id'           => 2,
            'balance'           => 0,
            'balance_archive'   => 0,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
