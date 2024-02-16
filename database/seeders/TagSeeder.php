<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;


class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tag1 = new Tag();
        $tag1->title = "Жизнь";
        $tag1->slug = str_slug($tag1->title);
        $tag1->save();

        $tag2 = new Tag();
        $tag2->title = "Путешествие";
        $tag2->slug = str_slug($tag2->title);
        $tag2->save();

        $tag3 = new Tag();
        $tag3->title = "Айти";
        $tag3->slug = str_slug($tag3->title);
        $tag3->save();
    }
}
