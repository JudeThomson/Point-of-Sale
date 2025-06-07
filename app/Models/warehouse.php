<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    
    protected $primaryKey = '_id';
    protected $fillable = [
        'warehouse_name',
        'warehouse_code',
        'warehouse_status',
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
