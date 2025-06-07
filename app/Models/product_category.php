<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $primaryKey = '_id';
    protected $fillable = [
        'category_code',
        'category',
        'server_time',
        'update_date',
        'update_status'
    ];

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
