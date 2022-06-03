<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
          'name' => 'taskname',
          'description' => 'task description',
          'completed_flag' => 'completed',
          'created_at' => now(),
          'updated_at' => now()
      ];
    }
}
