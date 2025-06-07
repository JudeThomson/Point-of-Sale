<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petty extends Model
{
    use HasFactory;
    protected $table = 'petty_main';
    protected $primaryKey = '_id';
    protected $fillable = [
        'petty_account_code',
        'petty_account_name',
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
    public function getCategoryAttribute($value)
    {
        $categoryMap = [
            1 => 'Income',
            2 => 'Expense',
        ];

        return $categoryMap[$value];
    }
}
