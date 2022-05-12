<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Waterbase extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';

    public string $uuid;
    public string $name;
    public string $region_uuid;

    public static function findByNameOrFail(string $name): Waterbase
    {
        return Waterbase::whereRaw('lower(name) like lower(\'%'.$name.'%\')')->first() ?? throw new
            ModelNotFoundException();
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function volume()
    {
        return $this->hasOne(Volume::class, 'waterbase_uuid');
    }
}
