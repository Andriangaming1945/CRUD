<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $table = 'actions';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
    ];
}
