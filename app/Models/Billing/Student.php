<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student';

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
        'customer_id',
        'biller_id',
        'user_id'
    ];

    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Customer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biller()
    {
        return $this->belongsTo(Biller::class, 'biller_id');
    }

    /**
     * Get the students privileges.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function privileges()
    {
        return UserPrivilege::where('student_can', true)->get();
    }
}