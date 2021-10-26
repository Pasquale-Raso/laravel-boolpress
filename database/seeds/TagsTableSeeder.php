<?php
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tagNames =['FrontEnd', 'BackEnd', 'FullStack', "UI/UX", 'Design', 'DevOps'];
        foreach ($tagNames as $name){
            $tag= new Tag();
            $tag->name = $name;
            $tag->color =$faker->hexColor();
            $tag->save();

        }
    }
}
