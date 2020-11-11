<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'html',
            'css',
            'Js',
            'php',
            'laravel',
            'linux',
            'templete engine',
            'framework',
            'vue',
            'react',
            'angular',
            'design partner'
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag;
            $newTag->name = $tag;

            $newTag->save();
        }
    }
}
