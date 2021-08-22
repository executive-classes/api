<?php

namespace App\Models\Billing\Teacher;

use App\Models\Billing\UserPrivilege\UserPrivilege;

trait TeacherFunctions
{
    /**
     * Get the teacher privileges.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function privileges()
    {
        return UserPrivilege::where('teacher_can', true)->get();
    }
}