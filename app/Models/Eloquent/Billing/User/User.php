<?php

namespace App\Models\Eloquent\Billing\User;

use App\Traits\Models\Billing\HasTax;
use App\Support\QueryFilter\Filterable;
use App\Traits\Models\Billing\HasPhone;
use App\Enums\System\SystemLanguageEnum;
use Illuminate\Notifications\Notifiable;
use App\Traits\Models\Billing\HasPrivileges;
use App\Traits\Models\Authentication\CanCrossAuth;
use App\Traits\Models\Authentication\CanAuthenticate;
use Illuminate\Foundation\Auth\User as Authenticable;
use App\Traits\Models\HasFactory;
use App\Traits\Models\Authentication\CanChangeLanguage;
use App\Traits\Models\Authentication\HasApiTokens;

class User extends Authenticable
{
    use UserRelations;
    use UserScopes;
    use UserMutators;
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
}
