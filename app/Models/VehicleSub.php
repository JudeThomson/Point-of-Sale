<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSub extends Model
{
    use HasFactory;
    protected $table = 'vehicle_sub';
    protected $primaryKey = '_id';
    protected $fillable = [
        'vehicle_expense_no', 
        'vehicle_expense_code', 
        'amount', 
        'remark', 
        'server_time', 
        'update_date', 
        'update_status'
    ];
    public function VehicleNo()
    {
        return $this->belongsTo(VehicleMain::class, 'vehicle_expense_no', 'vehicle_expense_no');
    }
    public function vehicleExpense()
{
    return $this->belongsTo(Vehicle_expense::class, 'vehicle_expense_code');  
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
