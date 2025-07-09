<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Test User',
            'role' => 'admin',
            'active' => true,
            'email' => 'test@example.com',
            'created_by'=> 1,
        ]);

        $user->update(['created_by' => $user->id]);

        $productList = [
            [
                'name'      => 'Euodia',
                'image'     => 'Group206.png',
                'banner'    => 'Group216.png'
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => 'Group216.png'
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => 'Group216.png'
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => 'Group216.png'
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => 'Group216.png'
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => NULL
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => NULL
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => NULL
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group362.png',
                'banner'    => NULL
            ],
            [
                'name'      => 'Euodia',
                'image'     => 'Group206.png',
                'banner'    => NULL
            ],
        ];

        foreach ($productList as $prod) {
            Product::create([
                'name'      => $prod['name'],
                'image'     => $prod['image'],
                'banner'    => $prod['banner'],
                'price'     => 9999980,
                'qty'       => 1,
                'unit'      => 'Botle',
                'active'    => true,
                'created_by'=> $user->id,
            ]);
        }
        
    }
}
