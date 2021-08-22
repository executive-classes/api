<?php

namespace App\Traits\Models\Billing;

use App\Models\Billing\Student\Student;
use App\Models\Billing\Teacher\Teacher;

trait HasPrivileges
{
    /**
     * Get the user's privileges by its type and unique privileges.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPrivileges()
    {
        $result = $this->privileges->keyBy('id');

        if (isset($this->employee)) {
            $result = $result->merge($this->employee->position->privileges->keyBy('id'));
        }

        if (isset($this->student)) {
            $result = $result->merge(Student::privileges());
        }

        if (isset($this->teacher)) {
            $result = $result->merge(Teacher::privileges());
        }

        return $result->values();
    }
}