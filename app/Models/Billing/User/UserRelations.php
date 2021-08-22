<?php

namespace App\Models\Billing\User;

use App\Models\System\SystemLanguage\SystemLanguage;
use App\Models\Billing\Student\Student;
use App\Models\Billing\TaxType\TaxType;
use App\Models\Billing\Teacher\Teacher;
use App\Models\Billing\Customer\Customer;
use App\Models\Billing\Employee\Employee;
use App\Models\Billing\UserPrivilege\UserPrivilege;

trait UserRelations
{
    /**
     * User tax type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxType()
    {
        return $this->belongsTo(TaxType::class, 'tax_type_id');
    }

    /**
     * User alternative tax type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxTypeAlt()
    {
        return $this->belongsTo(TaxType::class, 'tax_type_alt_id');
    }

    /**
     * User preffered language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(SystemLanguage::class, 'system_language_id', 'id');
    }

    /**
     * User privileges relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(UserPrivilege::class, 'privilege_x_user', 'user_id', 'user_privilege_id');
    }

    /**
     * Customer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_x_user', 'user_id', 'customer_id');
    }

    /**
     * Employee relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }

    /**
     * Teacher relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id', 'id');
    }

    /**
     * Student relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }
}