<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {

            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->get();
            $post->tags()->sync($tags);
        }
    }
}
