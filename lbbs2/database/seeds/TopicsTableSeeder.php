<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{

    public function run()
    {
        $users_id=User::all()->pluck('id')->toArray();

        $categories_id=User::all()->pluck('id')->toArray();

        $faker=app(Faker\Generator::class);


        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use($faker,$users_id,$categories_id) {
            $topic->user_id=$faker->randomElement($users_id);
            $topic->category_id=$faker->randomElement($categories_id);
        });

        Topic::insert($topics->toArray());
    }

}

