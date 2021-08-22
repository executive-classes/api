<?php

namespace App\Models\Billing\Student;

use App\Models\Billing\UserPrivilege\UserPrivilege;

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