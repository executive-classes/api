<?php

namespace App\Models\Billing\CollectionItem;

use App\Models\Billing\Student\Student;
use App\Models\Billing\Collection\Collection;

trait CollectionItemRelations
{
    /**
     * Collection relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    /**
     * Student relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}