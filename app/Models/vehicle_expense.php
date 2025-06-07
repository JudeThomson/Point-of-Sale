<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle_expense extends Model
{
    use HasFactory;
    protected $table = 'vehicle_expense';
    protected $primaryKey = '_id';
    protected $fillable = [
        'vehicle_expense_code',
        'vehicle_expense_name',
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
