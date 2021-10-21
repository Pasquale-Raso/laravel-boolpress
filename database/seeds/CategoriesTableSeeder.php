<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = ['HTML', 'JS', 'CSS', 'SASS', 'PHP', 'VueJS', 'Laravel'];

        foreach ($category_names as $name) {
            $category = new Category();

            $category->name = $name;

            $category->save();

        }
    }
}
