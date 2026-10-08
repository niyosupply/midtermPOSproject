<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'           => 'Laptop',
                'price'          => 35000.00,
                'stock_quantity' => 10,
                'image'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Wireless Mouse',
                'price'          => 750.00,
                'stock_quantity' => 25,
                'image'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Mechanical Keyboard',
                'price'          => 2500.00,
                'stock_quantity' => 15,
                'image'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'USB-C Cable',
                'price'          => 450.00,
                'stock_quantity' => 30,
                'image'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Headset',
                'price'          => 1800.00,
                'stock_quantity' => 12,
                'image'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}