<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DropdownController extends Controller
{
    public function index(){
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        return view('issues.create')->with('list',$list)->with('list2',$list2)->with('arealist',$arealist);
    }

}
