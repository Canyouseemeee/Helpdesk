<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use App\Issues_Tracker;
use DB;


class IssuesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DB::table('issues_tracker')
        ->select('Issuesid','ISTName','ISPName','ISSName','Users','Subject','Description')
        ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
        ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
        ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
        ->orderBy('Issuesid','ASC')
        ->get();
        
        $data=Issues::all();
        return view('index',compact(['data'],['list']));

    }

    public function getAdd(){
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        return view('issues.create')->with('list',$list)->with('list2',$list2)->with('arealist',$arealist);

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tracker' => ['required', 'int', 'max:255'],
            'priority' => ['required', 'int', 'max:255'],
            'status' => ['required', 'int', 'max:255'],
            'users' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Issues::create([
            'tracker' => $data['tracker'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'users' => $data['users'],
            'subject' => $data['subject'],
            'description' => $data['description'],
        ]);
        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject'=>'required',
            'description'=>'required'
        ]);
        // echo print_r($request->all());
        Issues::create($request->all());
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Issuesid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Issuesid)
    {
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        $data=Issues::find($Issuesid);
        return view('issues.edit',compact(['data'],['list'],['list2'],['arealist']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Issuesid)
    {
        $request->validate([
            'subject'=>'required',
            'description'=>'required'
        ]);
       
        Issues::find($Issuesid)->update($request->all());
        return redirect('/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Issuesid)
    {
        
        Issues::find($Issuesid)->delete();
        return redirect('/index');
    }
}
