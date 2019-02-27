<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'role_id'       => 1,
            'name'          => 'Admin',
            'surname'       => '',
            'email'         => 'admin@igra.kz',
            'password'      => '$2y$10$9jRfsPZlUrtOTtik3opIvOfMLDfB97/sQ0kIIJ4IuQ/IaTQetqMHG',
            'gender'        => 1,
            'address'       => 'пр. Абая 10а, уг.пр. Назарбаева',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
