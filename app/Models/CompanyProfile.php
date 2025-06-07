<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';

    protected $fillable = [
        'company_name',
        'address1',
        'address2',
        'address3',
        'mobile',
        'email',
        'phone',
        'website',
        'server_time',
        'person_name',
        'company_reg_no',
        'update_date',
        'update_status',
        'currency',
        'tin_no',
        'lock_status',
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
