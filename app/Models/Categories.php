<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    static $availableStatus = [
        'ACTIVO',
        'CANCELADO',
        'ELIMINADO'
    ];

    protected $fillable = ['name','status'];

    protected $guarded = ['id'];

    public static function getAllowedStatuses(){
        return self::$availableStatus;
    }

}
