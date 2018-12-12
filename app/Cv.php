<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'user_id', 'job_id', 'attachment'
    ];

	/**
     * Get the user that owns the task.
     */
	public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the user that owns the task.
     */
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
