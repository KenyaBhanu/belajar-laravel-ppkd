<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'major_id',
        'name',
        'phone'
    ];

    public function major()
    {
        return $this->BelongsTo(Major::class, 'major_id', 'id');
    }
}
