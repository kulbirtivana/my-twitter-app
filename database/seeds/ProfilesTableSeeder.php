<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class ProfilesTableSeeder extends Seeder
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

        foreach(range(1, 30) as $index ){
        	DB::table( 'profiles' )->insert(array(
        		'name' => $faker->name,
        		'photo' => $faker->imageUrl(600, 400),
        		'about_user' => $faker->paragraph,
                'user_id' => $faker->unique()->randomElement(User::pluck('id')->toArray()),
        	));
        }
    }
}
