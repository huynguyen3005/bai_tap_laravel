<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(30)->create();
        Role::factory(3)->create();
        Admin::factory(10)->create();
        Customer::factory(10)->create();
    }
}
