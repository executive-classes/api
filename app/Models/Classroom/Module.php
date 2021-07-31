<?php

namespace App\Models\Classroom;

use App\Models\Billing\Student;
use App\Models\General\Category;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'module';

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
        'active',
        'category_id'
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
     * Category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'module_x_student', 'module_id', 'student_id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'module_id', 'id');
    }

    /**
     * Course relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Test relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }
}