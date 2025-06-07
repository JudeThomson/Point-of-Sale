<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = '_id';
    protected $fillable = [
        'product_code',
        'hsn_code',
        'product_name',
        'pcode',
        'photo',
        'reorder_level',
        'unit_of_msrment',
        'category_code',
        'status',
        'barcode_type',
        'description',
        'selling_per',
        'selling_rate',
        'tax_per',
        'cgst',
        'sgst',
        'igst',
        'barcode_text_pos',
        'description_pos',
        'barcode_text',
        'barcode_size',
        'server_time',
        'min_level',
        'update_date',        
        'update_status'
    ];
    public function category()
    {
        return $this->belongsTo(product_category::class, 'category_code', 'category_code');
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
