<?php

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CommunityFactory extends Factory
{
    protected $model = Community::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->text(30),
            'user_id' => rand(1, 100),
            'description' => $this->faker->text(200),
            'slug' => Str::slug($name),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
