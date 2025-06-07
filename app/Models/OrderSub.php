<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSub extends Model
{
    use HasFactory;
    protected $table = 'order_sub';
    protected $primaryKey = '_id';
    protected $fillable = [
        'order_no',
        'product_code',
        'quantity',
        'server_time',
        'update_date',
        'update_status'
    ];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_code', 'product_code');
    }
    public function order()
    {
        return $this->belongsTo(OrderMain::class, 'order_no', 'order_no');
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
