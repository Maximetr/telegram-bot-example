<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Region extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'area_names' => 'array',
    ];

    public string $uuid;
    public string $name;
    public string $area_names;

    public static function findByAreaNameOrFail(string $areaName): Region
    {
        return Region::whereRaw('lower(area_names) like lower(\'%'.$areaName.'%\')')->first() ?? throw new
            ModelNotFoundException();
    }

    public function waterbases()
    {
        return $this->hasMany(Waterbase::class, 'region_uuid');
    }
}
