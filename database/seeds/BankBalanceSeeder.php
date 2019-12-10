<?php

use Illuminate\Database\Seeder;

class BankBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balance_bank')->insert([
            'balance'           => 10000000,
            'balance_archive'   => 0,
            'code'              => '014',
            'enable'            => true,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
