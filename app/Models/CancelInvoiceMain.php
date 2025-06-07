<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelInvoiceMain extends Model
{
    protected $table = 'cancel_invoice_main';
    protected $primaryKey = '_id';

    protected $fillable = [
        'date_field',
        'time_field',
        'invoice_no',
        'remark',
        'amount',
        'user_id',
        'less_amt',
        'round_off',
        'customer_id',
        'warehouse_code',
        'server_time',
        'update_date',
        'update_status',
    ];
    public function invoiceNo()
    {
        return $this->belongsTo(CancelInvoiceSub::class, 'invoice_no', 'invoice_no');
    }
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
