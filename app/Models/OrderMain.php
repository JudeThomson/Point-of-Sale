<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMain extends Model
{
    use HasFactory;
    protected $table = 'order_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'customer_id',
        'order_no',
        'user_id',
        'date_field',
        'status',
        'advance',
        'server_time',
        'update_date',
        'update_status'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
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
