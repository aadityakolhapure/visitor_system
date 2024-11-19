<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visitor extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'unique_id',
        'name',
        'member_count',
        'member1',
        'member2',
        'member3',
        'phone',
        'department_id',
        'meet_user_id',
        'meet',
        'purpose',
        'photo',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function meetUser()
    {
        return $this->belongsTo(User::class, 'meet_user_id');
    }
}
