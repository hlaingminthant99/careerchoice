<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id', 'job_name', 'job_type', 'salary', 'job_discription', 'job_location', 'requirement'
    ];

    /**
     * Get the user that owns the task.
     */
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
