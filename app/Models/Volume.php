<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    public int $volume;
    public string $waterbase_uuid;

    public function waterbase()
    {
        return $this->belongsTo(Waterbase::class);
    }
}
