<?php
namespace App\Models\Billing;

use App\Enums\Billing\StateEnum;
use App\Services\Billing\Tax\Contract\Tax;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TaxType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tax_type';

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

    /**
     * Get a instance of a Tax.
     *
     * @return Tax
     */
    public function tax(): Tax
    {
        $tax = 'App\\Services\\Billing\\Tax\\' . Str::ucfirst($this->id);
        return new $tax();
    }

    /**
     * Validate a tax.
     *
     * @param string $value
     * @param StateEnum $state
     * @return boolean
     */
    public function validate(string $value, StateEnum $state = null): bool
    {
        return $this->tax()->validate($value, $state);
    }

    /**
     * Mask a tax.
     *
     * @param string $value
     * @param StateEnum $state
     * @return string
     */
    public function mask(string $value, StateEnum $state = null): string
    {
        return $this->tax()->mask($value, $state);
    }
}