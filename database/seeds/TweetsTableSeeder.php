<?php

use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $faker = Faker\Factory::create();

        foreach(range(1, 25 ) as $index){
            DB::table( 'tweets')->insert(array(
                'user_id' => rand(1,25),
                'message' => $faker->catchphrase
            ));
        }
    }
}
