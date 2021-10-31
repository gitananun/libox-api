<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseObserver
{
    /**
     * Handle the Course "create" event.
     *
     * @param  \App\Models\Course $course
     * @return void
     */
    public function creating(Course $course)
    {
        $course->slug = Str::slug($course->title);
    }

    /**
     * Handle the Course "update" event.
     *
     * @param  \App\Models\Course $course
     * @return void
     */
    public function updating(Course $course)
    {
        $course->slug = Str::slug($course->title);
    }
}