<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransSub extends Model
{
    use HasFactory;
    protected $table = 'stock_trans_sub';
    protected $primaryKey = '_id';

    protected $fillable = [
        'trans_no',
        'product_code',
        'quantity',
        'batch_code',
        'server_time',
        'update_date',
        'update_status'
    ];

    public function stockTransMain()
    {
        return $this->belongsTo(StockTransMain::class, 'trans_no', 'trans_no');
    }

    public function Product()
    {
        return $this->belongsTo(product::class, 'product_code', 'product_code');
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
