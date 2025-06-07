<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_main extends Model
{
    use HasFactory;
    protected $table = 'purchase_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'po_no',
        'vendor_code',
        'date_field',
        'status',
        'remark',
        'overhead_amount',
        'server_time',
        'update_date', 
        'cancel_date',       
        'update_status'  
    ];
    public function purchase()
    {
        return $this->belongsTo(purchase_sub::class, 'po_no', 'po_no');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_code', 'vendor_code');
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
