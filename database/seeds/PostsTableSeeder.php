<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use App\User;
// Importo la classe per lo slag
use Illuminate\Support\Str;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {

            $user = User::inRandomOrder()->first();

            $newPost = new Post;
            $newPost->user_id = $user->id;
            $newPost->title = $faker->sentence(8, true);
            $newPost->content = $faker->paragraph(15, true);
            $newPost->excerpt = $faker->paragraph(3);
            $newPost->published = rand(0, 1);
            // Prendi la stringa e fai qualcosa
            $newPost->slug = Str::of($newPost->title)->slug();

            $newPost->save();
        }
    }
}
