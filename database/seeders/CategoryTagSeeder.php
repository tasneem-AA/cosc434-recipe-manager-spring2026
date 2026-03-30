<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;

class CategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Category::create(['name' => 'Breakfast']);
        Category::create(['name' => 'Lunch']);
        Category::create(['name' => 'Dinner']);
        Category::create(['name' => 'Dessert']);

        // Insert tags
        Tag::create(['name' => 'Quick']);
        Tag::create(['name' => 'Healthy']);
        Tag::create(['name' => 'Vegetarian']);
        Tag::create(['name' => 'Easy']);
    
    }
}
