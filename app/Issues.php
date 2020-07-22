<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $primaryKey = 'Issuesid';
    protected $fillable = [
        'Trackerid','Priorityid','Statusid','Departmentid','users','subject','description','fileupload1'
    ];
}
