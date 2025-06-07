<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petty_Sub extends Model
{
    use HasFactory;
    protected $table = 'petty_sub';
    protected $primaryKey = '_id';
    protected $fillable = [
        'petty_code',
        'transaction_field',
        'petty_account_code',
        'amount',
        'remark',
        'transaction_date',
        'server_time',
        'update_date',
        'update_status'
    ];
    public function pettyEntry()
    {
        return $this->belongsTo(Petty_Entry::class, 'petty_code', 'petty_code');
    }
    public function pettyMain()
    {
        return $this->belongsTo(Petty::class, 'petty_account_code', 'petty_account_code');
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
