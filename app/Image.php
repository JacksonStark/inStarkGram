<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    // Get the owning imageable model (User or Post)
    public function imageable()
    {
        return $this->morphTo();
    }
}
