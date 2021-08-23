<?php

namespace App\Models\Eloquent\Billing\Student;

use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;

trait StudentFunctions
{
    /**
     * Get the students privileges.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function privileges()
    {
        return UserPrivilege::where('student_can', true)->get();
    }
}