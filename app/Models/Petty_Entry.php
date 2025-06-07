<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petty_Entry extends Model
{
    use HasFactory;
    protected $table = 'petty_entry';
    protected $primaryKey = '_id';
    protected $fillable = [
        'petty_code',
        'current_balance',
        'user_id',
        'transaction_date',
        'server_time',
        'update_date',
        'update_status'
    ];
    public $timestamps = false;
}
