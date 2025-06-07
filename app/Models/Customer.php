<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = '_id';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'address1',
        'address2',
        'address3',
        'state_stat',
        'mobile',
        'email',
        'credit_limit',
        'remark',
        'server_time',
        'update_date',        
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
