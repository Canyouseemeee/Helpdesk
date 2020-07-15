<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $fillable = [
        'Tracker','Priority','Status','users','subject','description'
    ];
}
