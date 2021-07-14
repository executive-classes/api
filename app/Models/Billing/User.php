<?php

namespace App\Models\Billing;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\System\SystemLanguageEnum;
use App\Filters\Filterable;
use App\Models\System\SystemLanguage;
use App\Traits\Authentication\Authenticable as CanAuthenticate;
use App\Traits\Authentication\CanChangeLanguage;
use App\Traits\Authentication\CanCrossAuth;
use App\Traits\Models\Billing\HasPhone;
use App\Traits\Models\Billing\HasPrivileges;
use App\Traits\Models\Billing\HasTax;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use Notifiable;
    use Filterable;
    use CanAuthenticate;
    use CanChangeLanguage;
    use CanCrossAuth;
    use HasPrivileges;
    use HasApiTokens;
    use HasFactory;
    use HasPhone;
    use HasTax;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_reminder',
        'tax_type_id',
        'tax_code',
        'tax_type_alt_id',
        'tax_code_alt',
        'phone',
        'phone_alt',
        'system_language_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
        'system_language_id' => SystemLanguageEnum::PT_BR
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
    ];

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

    /**
     * Password attribute mutator.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * User Status scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * User Inactive Status scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * User Role Scope
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeRole($query, $value)
    {
        switch ($value) {
            case 'student':
                return $query->whereHas('student');
                break;

            case 'teacher':
                return $query->whereHas('teacher');
                break;
            
            default:
                return $query->whereHas('employee', function ($q) use ($value) {
                    $q->where('employee_position_id', $value);
                });
                break;
        }
    }
    
    /**
     * Administrator User scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdmin($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::ADMINISTRATOR);
        });
    }

    /**
     * Developer User scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDev($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::DEVELOPER);
        });
    }
}
