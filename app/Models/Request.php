<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the worker for the request.
     */
    public function worker()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the refugee for the request.
     */
    public function refugee()
    {
        return $this->belongsTo(User::class);
    }
}
