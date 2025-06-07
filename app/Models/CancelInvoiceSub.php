<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelInvoiceSub extends Model
{
    use HasFactory;

    protected $table = 'cancel_invoice_sub'; 
    protected $primaryKey = '_id';

    protected $fillable = [
        'invoice_no',
        'product_code',
        'batch_code',
        'quantity',
        'free',
        'rate',
        'tax',
        'amount',
        'server_time',
        'update_date',
        'update_status',
    ];
    public function invoiceNo()
    {
        return $this->belongsTo(CancelInvoiceMain::class, 'invoice_no', 'invoice_no');
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
