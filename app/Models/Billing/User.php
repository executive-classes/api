<?php

namespace App\Models\Billing;

use App\Models\System\SystemLanguage;
use App\Traits\Authentication\Authenticable as CanAuthenticate;
use App\Traits\Authentication\CanChangeLanguage;
use App\Traits\Authentication\HasCrossAuth;
use App\Traits\Models\Billing\HasPrivileges;
use App\Traits\Models\Billing\HasTax;
use App\Traits\Scopes\Billing\UserScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use UserScopes, HasPrivileges, CanAuthenticate, CanChangeLanguage, HasCrossAuth, HasApiTokens, HasFactory, Notifiable, HasTax;

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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'inactve_at',
        'reactive_at',
        'email_verified_at',
        'salt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'password_reminder'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true
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
        return $this->belongsTo(TaxType::class, 'tax_type_id', 'id');
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
        return $this->hasOne(Teacher::class, 'id', 'user_id');
    }

    /**
     * Student relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'user_id');
    }
}
