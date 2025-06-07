<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_sub extends Model
{
    use HasFactory;
    protected $table = 'purchase_sub';
    protected $primaryKey = '_id';
    protected $fillable = [
        'po_no',
        'vendor_code',
        'product_code',
        'unit_of_msrment',
        'quantity',
        'trans_qty',
        'date_field',
        'status',
        'server_time',
        'update_date',        
        'update_status'  
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_code', 'vendor_code');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
    public function existsInPurchaseMain()
    {
        return purchase_main::where('po_no', $this->po_no)->exists();
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
