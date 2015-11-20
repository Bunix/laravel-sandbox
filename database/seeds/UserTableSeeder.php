<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    private $seed_number = 10;

    public function run()
    {
        factory(App\Models\User\User::class, $this->seed_number)->create();
    }

}