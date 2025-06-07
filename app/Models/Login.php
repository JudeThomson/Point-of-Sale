<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use HasFactory;
    protected $table = 'login';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'staff_id', 
        'password', 
        'server_time', 
        'update_date', 
        'is_admin', 
        'update_status',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
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
