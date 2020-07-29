<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $primaryKey = 'Issuesid';
    protected $fillable = [
        'Trackerid','Priorityid','Statusid','Departmentid','users','subject','description'
        ,'Date_In','fileupload1','created_at','updated_at'
    ];
    
}
