<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kpop extends Model {

    protected $table = 'agencies';

    protected $fillable = [
        'nama', 'ceo', 'logo', 'berdiri', 'medsos'
    ];
}
