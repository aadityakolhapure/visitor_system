<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
