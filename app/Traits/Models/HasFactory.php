<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory as DefaultFactory;

trait HasFactory
{
    use DefaultFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        $factory = preg_replace('/App\\\Models\\\Eloquent/', 'Database\Factories', get_called_class()) . 'Factory';
        return new $factory();
    }
}