<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 100),
            'community_id' => rand(1, 50),
            'title' => $this->faker->text(50),
            'post_text' => $this->faker->text(400),
            'post_url' => $this->faker->url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),


        ];
    }
}
