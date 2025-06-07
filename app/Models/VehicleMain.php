<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMain extends Model
{
    use HasFactory;
    protected $table = 'vehicle_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'date_field', 
        'vehicle_no', 
        'vehicle_expense_no', 
        'staff_id', 
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
