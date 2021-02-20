<?php

namespace App\Models\Billing;

use App\Traits\Authenticatable as CanAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CanAuthenticate, HasApiTokens, HasFactory, Notifiable;

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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true
    ];

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
        'password_reminder',
        'salt'
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
     * User roles relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_x_role', 'user_id', 'user_role_id');
    }

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
     * Get the user's privileges using their roles.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function privileges()
    {
        $roles = $this->roles;
        $privileges = new \Illuminate\Database\Eloquent\Collection();

        foreach ($roles as $role) {
            $privileges = $privileges->merge($role->privileges->keyBy('id'));
        }

        return $privileges->values();
    }
}
