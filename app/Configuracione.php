<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    protected $primaryKey = 'key';
    protected $casts = [
        'key' => 'string',
    ];
}
