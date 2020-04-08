<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\profile;
use App\tweet;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        foreach( range(1,10) as $index ){
        	DB::table('comments')->insert(array(
        		'content' => $faker->paragraph,
        		'profile_id' => $faker->randomElement(profile::pluck('id')->toArray()),
                'tweet_id' => $faker->randomElement(tweet::pluck('id')->toArray()),
        	));
        }
    }
}
