<?php

namespace App\Traits\Factories\System;

trait AjaxStates
{
    /**
     * Indicate that the log was a ajax request.
     *
     * @param boolean $wasAjax
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ajax(bool $wasAjax = true)
    {
        return $this->state(function (array $attributes) use ($wasAjax) {
            return [
                'ajax' => $wasAjax,
            ];
        });
    }
}