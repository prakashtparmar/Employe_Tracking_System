<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            ['parent_id' => null, 'name' => 'Clothing', 'url' => 'clothing'],
            ['parent_id' => null, 'name' => 'Electronics', 'url' => 'electronics'],
            ['parent_id' => null, 'name' => 'Appliances', 'url' => 'appliances'],
            ['parent_id' => 1, 'name' => 'Men', 'url' => 'men'], // Assuming 1 is the ID for 'Clothing'
            ['parent_id' => 1, 'name' => 'Women', 'url' => 'women'], // Assuming 1 is the ID for 'Clothing'
            ['parent_id' => 1, 'name' => 'Kids', 'url' => 'kids'],   // Assuming 1 is the ID for 'Clothing'
        ];

        foreach ($categories as $data) {
            Category::create([
                'parent_id'       => $data['parent_id'],
                'name'            => $data['name'],
                'url'             => $data['url'],
                'image'           => '', // You might want to generate these or have default values
                'size_chart'      => '',
                'discount'        => 0,
                'description'     => '',
                'meta_title'      => '',
                'meta_description' => '',
                'meta_keywords'     => '',
                'status'          => 1,
                'menu_status'     => 1,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);
        }
    }
}
