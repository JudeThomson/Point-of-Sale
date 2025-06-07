<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grnp_sub extends Model
{
    use HasFactory;
    protected $table = 'grnp_sub';
    protected $primaryKey = '_id';
    public $timestamps = false;
    protected $fillable = [
        'date_field',
        'grnp_no',
        'product_code',
        'quanity',
        'purchase_rate',
        'selling_rate',
        'tax',
        'cgst',
        'sgst',
        'igst',
        'reorder_level',
        'mfg_date',
        'expiry_date',
        'batch_code',
        'server_time',
        'update_date',
        'update_status',
        
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_code', 'product_code');
    }
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
