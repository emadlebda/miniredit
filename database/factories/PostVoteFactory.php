<?php

namespace Database\Factories;

use App\Models\PostVote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostVoteFactory extends Factory
{
    protected $model = PostVote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $votes = [-1, 1];
        return [
            'post_id' => rand(1, 300),
            'user_id' => rand(1, 100),
            'vote' => $votes[rand(0, 1)],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
