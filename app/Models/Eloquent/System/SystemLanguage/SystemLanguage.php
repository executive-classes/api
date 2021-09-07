<?php
namespace App\Models\Eloquent\System\SystemLanguage;

use App\Models\Eloquent\System\SystemLanguage\SystemLanguageFunctions;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLanguage extends Model
{
    use SystemLanguageFunctions;
    use HasFactory;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
}