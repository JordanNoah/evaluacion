<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    static $availableStatus = [
        'ACTIVO',
        'CANCELADO',
        'ELIMINADO'
    ];

    protected $fillable = ['status','name','description','min_stock','category_id'];

    protected $guarded = ['id'];

    public static function getAllowedStatuses(){
        return self::$availableStatus;
    }
}
