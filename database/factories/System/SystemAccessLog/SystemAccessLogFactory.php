<?php

namespace Database\Factories\System\SystemAccessLog;

use Carbon\Carbon;
use Database\Factories\Factory;
use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\System\SystemAccessLog\SystemAccessLog;

class SystemAccessLogFactory extends Factory
{
    use SystemAccessLogFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemAccessLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allowed = $this->faker->boolean();

        return [
            'date' => Carbon::now()->toDateTimeString(),
            'user_id' => $this->relation(User::class),
            'agent' => $this->faker->text(10),
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'url' => $this->faker->url(),
            'route' => $this->faker->text(10),
            'ajax' => $this->faker->boolean(30),
            'allowed' => $allowed,
            'code' => $this->httpCode($allowed),
        ];
    }

    /**
     * Get the HTTP code.
     *
     * @param bool $success
     * @return void
     */
    private function httpCode(bool $success)
    {
        return $success
            ? $this->faker->numberBetween(200, 204)
            : $this->faker->numberBetween(400, 599);
    }
}