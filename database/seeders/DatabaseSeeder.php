<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Resources\RestaurantResrouce;
use App\Models\Category;
use App\Models\Food;
use App\Models\OpenTime;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\Fake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = collect([
            [
                "name" => "French food",
                "thumbnail" => asset("CategoryThumbnail/french.jpg"),
                "slug" => "french"
            ],
            [
                "name" => "Canadian food",
                "thumbnail" => asset("CategoryThumbnail/canada.jpeg"),
                "slug" => "canada"
            ],
            [
                "name" => "Chines food",
                "thumbnail" => asset("CategoryThumbnail/china.webp"),
                "slug" => "china"
            ],
            [
                "name" => "Iranian food",
                "thumbnail" => asset("CategoryThumbnail/iran.jpg"),
                "slug" => "iran"
            ]
        ]);

        $categories->each(function ($category, $index) use (&$categories) {
            DB::transaction(function () use ($categories, $category, $index) {
                $categories[$index] = Category::create($category);
                for($i = 0; $i < random_int(10, 20); $i++) {
                    $restaurant = Restaurant::create([
                        "name" => fake()->name(),
                        "slug" => fake()->slug(),
                        "description" => fake()->realText(100),
                        "thumbnail" => $category["thumbnail"],
                        "category_id" => $categories[$index]["id"],
                        "latitude" => fake()->latitude(),
                        "longitude" => fake()->longitude(),
                    ]);
                    collect(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->each(function ($day) use ($restaurant) {
                        OpenTime::create([
                            "restaurant_id" => $restaurant['id'],
                            "day" => $day,
                            "start_time" => fake()->time("H:i:s"),
                            "end_time" => fake()->time("H:i:s"),
                            "open" => fake()->boolean()
                        ]);
                    });
                    for($i = 0; $i < random_int(5, 10); $i++) {
                        Food::create([
                            "extra" => [],
                            "name" => fake()->time(),
                            "description" => fake()->realText(100),
                            "restaurant_id" => $restaurant['id'],
                        ]);
                    }
                }
            });
        });
    }
}
