<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory'; 
    protected $primaryKey = '_id';

    protected $fillable = [
        'product_code',
        'hsn_code',
        'cgst',
        'sgst',
        'igst',
        'date_field',
        'opening_balance',
        'receipt',
        'issue',
        'closing_balance',
        'mfg_date',
        'expiry_date',
        'rate_status',
        'selling_rate',
        'tax',
        'batch_code',
        'reorder_level',
        'warehouse_code',
        'server_time',
        'update_date',
        'update_status',
    ];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_code', 'product_code');
    }
    public function Warehouse()
    {
        return $this->belongsTo(warehouse::class, 'warehouse_code', 'warehouse_code');
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
