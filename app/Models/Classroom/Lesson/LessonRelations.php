<?php

namespace App\Models\Classroom\Lesson;

use App\Models\Classroom\Module\Module;
use App\Models\General\Category\Category;
use App\Models\Classroom\Material\Material;
use App\Models\Classroom\Question\Question;
use App\Models\Billing\Student\Student;
use App\Models\Billing\Teacher\Teacher;
use App\Models\Classroom\Course\Course;

trait LessonRelations
{
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
        return $this->belongsToMany(Student::class, 'lesson_x_student', 'lesson_id', 'student_id');
    }

    /**
     * Teachers relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'lesson_x_teacher', 'lesson_id', 'teacher_id');
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
     * Module relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    /**
     * Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'lesson_x_question', 'lesson_id', 'question_id');
    }

    /**
     * Materials relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'lesson_x_material', 'lesson_id', 'material_id');
    }
}