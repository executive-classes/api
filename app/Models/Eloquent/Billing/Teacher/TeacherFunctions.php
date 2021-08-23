<?php

namespace App\Models\Eloquent\Billing\Teacher;

use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;

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