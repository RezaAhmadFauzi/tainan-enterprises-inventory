<?php

namespace App\Models;

use App\Observers\SupplierObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
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
        'nama_supplier',
        'alamat',
        'status',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::observe(SupplierObserver::class);
    }
}
