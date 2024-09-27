<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'name',
        'department_id', 'member_count',
        'meet',
        'phone',
        'purpose',
        'photo',
        'check_in',
        'check_out',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function members()
    {
        return $this->hasMany(VisitorMember::class);
    }
}