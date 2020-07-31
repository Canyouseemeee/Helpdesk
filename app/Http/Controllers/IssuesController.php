<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use App\File;
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
        ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
        ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
        ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
        ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
        ->where([['issues.Statusid',1],['issues.Date_In',now()->toDateString()]])
        ->orderBy('Issuesid','DESC')
        ->paginate(10); 
        $data = Issues::all();
        $between = null;
        return view('index',compact(['data'],['list'],['between']));

    }

    public function getReport(request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        if ($request->isMethod('POST')) {
            $between = DB::table('issues_tracker')
            ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
            ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
            ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
            ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
            ->where('issues.Statusid',1)
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->orderBy('Issuesid','DESC')
            ->paginate(10);
        } else {
            $between = null;
        }
        $data = Issues::all();
        $list = null;
        return view('index',compact(['data'],['between'],['list']));

    }

    public function getClosed(){
        $list = DB::table('issues_tracker')
        ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
        ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
        ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
        ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
        ->where('issues.Statusid',2)
        ->orderBy('Issuesid','DESC')
        ->paginate(10);
        $data=Issues::all();
        $between = null;
        return view('closed',compact(['data'],['list'],['between']));
    }

    public function getReportClosed(request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        if ($request->isMethod('POST')) {
            $between = DB::table('issues_tracker')
            ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
            ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
            ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
            ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
            ->where('issues.Statusid',2)
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->orderBy('Issuesid','DESC')
            ->paginate(10);
        } else {
            $between = null;
        }
        $data = Issues::all();
        $list = null;
        return view('closed',compact(['data'],['between'],['list']));

    }

    public function getDefer(){
        $list = DB::table('issues_tracker')
        ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
        ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
        ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
        ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
        ->where('issues.Statusid',3)
        ->orderBy('Issuesid','DESC')
        ->paginate(10);
        $data=Issues::all();
        $between = null;
        return view('defer',compact(['data'],['list'],['between']));
    }

    public function getReportDefer(request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        if ($request->isMethod('POST')) {
            $between = DB::table('issues_tracker')
            ->select('Issuesid','ISTName','ISSName','ISPName','Users','Subject','created_at','updated_at')
            ->join('issues','issues.Trackerid','=','issues_tracker.Trackerid')
            ->join('issues_priority','issues.Priorityid','=','issues_priority.Priorityid')
            ->join('issues_status','issues.Statusid','=','issues_status.Statusid')
            ->where('issues.Statusid',3)
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->orderBy('Issuesid','DESC')
            ->paginate(10);
        } else {
            $between = null;
        }
        $data = Issues::all();
        $list = null;
        return view('closed',compact(['data'],['between'],['list']));
    }

    public function getAdd(){
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        // $arealist2 = DB::table('files')->get();
        $arealist3 = DB::table('department')->get();
        return view('issues.create',compact(['list'],['list2'],['arealist'],['arealist3']));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'trackerid' => ['required', 'int', 'max:255'],
            'priorityid' => ['required', 'int', 'max:255'],
            'statusid' => ['required', 'int', 'max:255'],
            'users' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'fileid' => ['required', 'string', 'max:255'],
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
            'trackerid' => $data['trackerid'],
            'priorityid' => $data['priorityid'],
            'statusid' => $data['statusid'],
            'users' => $data['users'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'date_in' => $data['date_in'],
            'fileid' => $data['fileid'],
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
            'description'=>'required',
            'fileupload1' => 'required|image|max:2048'
        ]);

        $fileupload1 = $request->file('fileupload1');
        $new_name = rand() . '.' . $fileupload1->
            getClientOriginalExtension();
        $fileupload1->move(public_path('fileupload1'), $new_name);
        $form_data = array(
            'subject' => $request->subject,
            'description' => $request->description,
            'fileupload1' => $new_name,
        );
        
        Issues::create($request->all(),$form_data);
        return redirect('/index')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Issuesid)
    {
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        $data=Issues::find($Issuesid);
        $arealist3 = DB::table('department')->get();
        return view('issues.view',compact(['data'],['list'],['list2'],['arealist'],['arealist3']));
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
        $arealist3 = DB::table('department')->get();
        return view('issues.edit',compact(['data'],['list'],['list2'],['arealist'],['arealist3']));
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
