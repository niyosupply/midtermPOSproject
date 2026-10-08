<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'full_name'  => 'Nash Resurreccion',
                'email'      => 'nash@niyosupply.com',
                'phone'      => '09171234567',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name'  => 'Marco Grageda',
                'email'      => 'marco@niyosupply.com',
                'phone'      => '09181234567',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name'  => 'Viyonce Yazar',
                'email'      => 'viyonce@niyosupply.com',
                'phone'      => '09191234567',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('customers')->insertBatch($data);
    }
}