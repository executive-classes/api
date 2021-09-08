<?php

namespace Database\Factories\System\SystemAuditLog;

use Carbon\Carbon;
use Database\Factories\Factory;
use App\Enums\System\AuditLogTypeEnum;
use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\System\SystemAuditLog\SystemAuditLog;

class SystemAuditLogFactory extends Factory
{
    use SystemAuditLogFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemAuditLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = AuditLogTypeEnum::getRandomValue();

        return [
            'id' => $this->id(),
            'date' => Carbon::now()->toDateTimeString(),
            'user_id' => $this->relation(User::class),
            'agent' => $this->faker->text(10),
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'url' => $this->faker->url(),
            'route' => $this->faker->text(10),
            'ajax' => $this->faker->boolean(30),
            'type' => $type,
            'table' => $this->faker->word,
            'before' => json_encode($this->getBefore($type)),
            'after' => json_encode($this->getAfter($type)),
        ];
    }

    /**
     * Get the before property.
     *
     * @param string $type
     * @return array
     */
    private function getBefore(string $type): array
    {
        if ($type == AuditLogTypeEnum::INSERT) {
            return [];
        }

        return [
            'data' => 1,
            'type' => 2
        ];
    }

    /**
     * Get the after property.
     *
     * @param string $type
     * @return array
     */
    private function getAfter(string $type): array
    {
        if ($type == AuditLogTypeEnum::DELETE) {
            return [];
        }
        
        return [
            'data' => 2,
            'type' => false
        ];
    }
}