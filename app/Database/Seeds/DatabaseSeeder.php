<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('ProductsSeeder');
        $this->call('CustomersSeeder');
        $this->call('UsersSeeder');
    }
}