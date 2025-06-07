<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';    
    protected $primaryKey = '_id';
    protected $fillable = [
        'vendor_code',
        'vendor_name',
        'address',
        'mobile',
        'email',
        'amount',
        'server_time',
        'update_date',
        'advance',
        'update_status'
    ];
    public $timestamps = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->update_date = now();
        });
        static::creating(function ($model) {
            $model->server_time = now();
        });

        static::updating(function ($model) {
            $model->update_date = now();
        });
    }
}
