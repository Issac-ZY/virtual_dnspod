<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    //
    protected $table = 'domains';

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';
}
