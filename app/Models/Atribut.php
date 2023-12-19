<?php

namespace App\Models;

use App\Observers\AtributObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 50;

    private static $statusName = array(
        self::STATUS_ACTIVE => "ACTIVE",
        self::STATUS_UNACTIVE => "UNACTIVE"
    );

    public function getStatusNameAttribute(): string
    {
        return self::$statusName[$this->status];
    }


    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'nama_atribut',
        'status',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::observe(AtributObserver::class);
    }

    public function details()
    {
        return $this->hasMany(AtributDetail::class, 'id_atribut');
    }

    protected static function booted () {
        static::deleting(function(Atribut $atribut) {
             $atribut->details()->delete();
        });
    }
}
