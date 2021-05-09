<?php

namespace App\Models\Billing;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teacher';

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
        'updated_at'
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
     * Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TeacherStatus::class, 'teacher_status_id');
    }

    /**
     * Get the teacher privileges.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function privileges()
    {
        return UserPrivilege::where('teacher_can', true)->get();
    }

    /**
     * Teacher Email Scope.
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeEmail($query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            return $q->where('email', $value);
        });
    }
}