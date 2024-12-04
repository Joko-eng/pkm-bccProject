<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['date', 'visit_count', 'ip_address', 'user_agent'];
}
