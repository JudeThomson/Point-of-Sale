<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $primaryKey = '_id';
    protected $fillable = [
        'staff_id',
        'staff_name',
        'address',
        'mobile',
        'email',
        'role_id',
        'warehouse_code',
        'server_time',
        'update_date',        
        'update_status'  
    ];
    public function role()
    {
        return $this->belongsTo(role::class, 'role_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouse::class, 'warehouse_code');
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
