<?php

namespace Database\Seeders;

use App\Models\Advert;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adverts = Advert::factory(10)->create();

        $faker = Faker::create();

        foreach ($adverts as $advert) {
            $imageUrl = $faker->imageUrl(640, 480, null, false);

            $advert->addMediaFromUrl($imageUrl)->toMediaCollection();
        }
    }
}
