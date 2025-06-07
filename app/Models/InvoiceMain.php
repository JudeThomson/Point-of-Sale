<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMain extends Model
{
    use HasFactory;
    protected $table = 'invoice_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'invoice_no',
        'cgst',
        'sgst',
        'igst',
        'advance',
        'round_off_val',
        'taxable_value',
        'bill_date',
        'less_amt',
        'round_off',
        'amount',
        'paid_amt',
        'bal_amt',
        'due_amt',
        'type_field',
        'customer_id',
        'user_id',
        'warehouse_code', 
        'curtomer_type',
        'server_time',
        'update_date',
        'update_status'
    ];
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
