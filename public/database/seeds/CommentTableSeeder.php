<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 200; $i++) {
            DB::table('comments')->insert([
                'name' => $faker->name,
                'article_id' => $faker->numberBetween(1,21),
                'email' => $faker->email,
                'text' => $faker->realText(50)
            ]);
        }

    }



}