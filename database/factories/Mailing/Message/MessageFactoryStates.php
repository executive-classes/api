<?php

namespace Database\Factories\Mailing\Message;

use App\Enums\Mailing\MessageStatusEnum;

trait MessageFactoryStates
{
    /**
     * Indicate that the message is scheduled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function scheduled()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::SCHEDULED,
            ];
        });
    }

    /**
     * Indicate that the message is sent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function sent()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::SENT,
            ];
        });
    }

    /**
     * Indicate that the message is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the message is with a error.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function error()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::ERROR,
            ];
        });
    }
}