<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorMember extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'name'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
