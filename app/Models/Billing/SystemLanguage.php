<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SystemLanguage extends Model
{
    /**
     * Languages
     */
    public const EN = 'en';
    public const PT_BR = 'pt_BR';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_language';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];
    
    /**
     * Update system locale.
     *
     * @return void
     */
    public function updateSystemLocale()
    {
        App::setLocale($this->id);
    }

}