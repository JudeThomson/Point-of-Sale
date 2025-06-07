<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSub extends Model
{
    use HasFactory;
    protected $table = 'invoice_sub';
    protected $primaryKey = '_id';
    protected $fillable = [
        'invoice_no',
        'cgst',
        'sgst',
        'igst',
        'less_amt',
        'product_code',
        'batch_code',
        'rate',
        'quantity',
        'free',
        'tax',
        'amount',
        'server_time',
        'update_date',
        'update_status'
    ];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_code', 'product_code');
    }
    public function invoice()
    {
        return $this->belongsTo(InvoiceMain::class, 'invoice_no', 'invoice_no');
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
