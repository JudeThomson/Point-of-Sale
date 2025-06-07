<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransMain extends Model
{
    use HasFactory;
    protected $table = 'stock_trans_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'trans_no',
        'trans_date',
        'user_id',
        'from_ware',
        'to_ware',
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
