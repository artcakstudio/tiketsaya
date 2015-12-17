<?php

use Illuminate\Database\Seeder;
use App\User;

class tesdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('tes')->delete();

        User::create(array('name' => 'coba','username'=>'coba', 'password'=>'coba'));
    }
}
