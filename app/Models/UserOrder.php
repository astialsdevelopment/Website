<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'order_no',
        'order_countity',
    ];
}
