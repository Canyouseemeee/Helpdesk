<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $primaryKey = 'Fileid';
    protected $fillable = [
        'name','size'
    ];
}
