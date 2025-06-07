<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grnp_main extends Model
{
    use HasFactory;
    protected $table = 'grnp_main';
    protected $primaryKey = '_id';
    public $timestamps = false;
    protected $fillable = [
        'date_field',
        'grnp_no',
        'po_no',
        'warehouse_code',
        'vendor_code',
        'dn_order_no',
        'tot_amt',
        'amount',
        'advance',
        'paid_amt',
        'type_field',
        'status',
        'transport_mode',
        'server_time',
        'update_date',
        'update_status',
        'dn_order_date',
    ];
    public function po_no()
    {
        return $this->belongsTo(purchase_main::class, 'po_no', 'po_no');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouse::class, 'warehouse_code', 'warehouse_code');
    }
    public function vendor()
    {
        return $this->belongsTo(vendor::class, 'vendor_code', 'vendor_code');
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
