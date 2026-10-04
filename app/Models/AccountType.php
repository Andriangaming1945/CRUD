<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AccountType extends Model
{
    use HasUuids;

    protected $table = 'account_type';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
    ];

    public function accounts()
    {
        return $this->hasMany(User::class, 'account_type_id');
    }
}