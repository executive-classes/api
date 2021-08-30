<?php

namespace Database\Factories\System\SystemAccessLog;

use App\Traits\Factories\System\AjaxStates;
use App\Traits\Factories\System\UserStates;

trait SystemAccessLogFactoryStates
{
    use UserStates;
    use AjaxStates;

    /**
     * Indicate that the log was allowed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function allowed()
    {
        return $this->state(function (array $attributes) {
            return [
                'allowed' => true,
            ];
        });
    }

    /**
     * Indicate that the log was allowed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unallowed()
    {
        return $this->state(function (array $attributes) {
            return [
                'allowed' => false,
            ];
        });
    }
}
