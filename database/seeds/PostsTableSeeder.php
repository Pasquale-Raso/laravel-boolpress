<?php
//! per fare il seeder-------------------------------------------
// use App\Models\Post;
// use illuminate\Support\Str;
//! -------------------------------------------------------------

 //? per fare il Fakers------------------------------------------

use Faker\Generator as Faker;
use illuminate\Support\Str;
use App\Models\Post;

  //? -----------------------------------------------------------
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    //! per fare il seeder-------------------------------------------------------------
    // public function run()
    // { 
    //         $posts = [
    //     [   'title' => 'il mio primo post',
    //             'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto blanditiis dicta quibusdam soluta qui consequatur quod animi neque voluptates expedita mollitia, facilis pariatur velit dolorem reprehenderit. Dicta dolor eum minima.',
    //             'image' => 'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'
    //         ],
    //     [ 'title' => 'il mio secondo post',
    //         'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto blanditiis dicta quibusdam soluta qui consequatur quod animi neque voluptates expedita mollitia, facilis pariatur velit dolorem reprehenderit. Dicta dolor eum minima.',
    //         'image' => 'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'
    //     ],
    //     [   'title' => 'il mio terzo post',
    //             'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto blanditiis dicta quibusdam soluta qui consequatur quod animi neque voluptates expedita mollitia, facilis pariatur velit dolorem reprehenderit. Dicta dolor eum minima.',
    //             'image' => 'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'
    //         ],
    //     [ 'title' => 'il mio quarto post',
    //         'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto blanditiis dicta quibusdam soluta qui consequatur quod animi neque voluptates expedita mollitia, facilis pariatur velit dolorem reprehenderit. Dicta dolor eum minima.',
    //         'image' => 'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'
    //         ]
    //     ];

    //     // inseriremo la logica per creare dei record sul database

    //     foreach($posts as $post){
    //         $newPost = new Post();

    //         $newPost->fill($post);
    //         $newPost->slug = Str::slug($newPost->title, '-');

    //         // $newPost->title = $post['title'];
    //         // $newPost->content = $post['content'];
    //         // $newPost->image = $post['image'];

    //         $newPost->save();
    //     }


    // }
    //! --------------------------------------------------------------------------------

    //? per fare il Fakers---------------------------------------------------------------

    public function run(Faker $faker)
    {
        for ($i=0; $i < 50; $i++) {
            $Post = new Post();

            $Post->title = $faker->text(50);
            $Post->content = $faker->paragraphs(2, true);
            $Post->image = $faker->imageUrl(250, 250);
            $Post->slug = Str::slug($Post->title, '-');

            $Post->save();
        }
            
    }
    //? -----------------------------------------------------------------------------------






}
