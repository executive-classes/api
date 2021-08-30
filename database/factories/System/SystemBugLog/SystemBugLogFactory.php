<?php

namespace Database\Factories\System\SystemBugLog;

use App\Enums\System\SystemAppEnum;
use Carbon\Carbon;
use Database\Factories\Factory;
use App\Models\Eloquent\System\SystemBugLog\SystemBugLog;
use Database\Factories\System\SystemBugLog\SystemBugLogFactoryStates;

class SystemBugLogFactory extends Factory
{
    use SystemBugLogFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemBugLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => Carbon::now()->toDateTimeString(),
            'user_id' => $this->relation(User::class),
            'agent' => $this->faker->text(10),
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'url' => $this->faker->url(),
            'route' => $this->faker->text(10),
            'ajax' => $this->faker->boolean(30),
            'app_id' => SystemAppEnum::getRandomValue(),
            'route' => $this->faker->text(10),
            'error' => json_encode(new \Exception($this->faker->text(10))),
        ];
    }
}