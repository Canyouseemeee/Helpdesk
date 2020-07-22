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
        ->orderBy('Issuesid','ASC')
        ->paginate(10);
        // ->get();
        
        $data=Issues::all();
        return view('index',compact(['data'],['list']));
            // ->with('i',(request()->input('page', 1) - 1) * 10);

    }

    public function getAdd(){
        $list = DB::table('issues_tracker')->get();
        $list2 = DB::table('issues_priority')->get();
        $arealist = DB::table('issues_status')->get();
        $arealist2 = DB::table('files')->get();
        $arealist3 = DB::table('department')->get();
        return view('issues.create',compact(['list'],['list2'],['arealist'],['arealist2'],['arealist3']));
    }

    // public function showUploadForm(){
    //     return view('upload');
    //     // return $request->all();
    // }
    
    // public function storeFile(request $request){
    //     if($request->hasFile('file')){
    //         $filename = $request->file->getClientOriginalName();
    //         $filesize = $request->file->getClientSize();
    //         $request->file->storeAs('public/upload',$filename);
    //         $file = new File;
    //         $file->name = $filename;
    //         $file->size = $filesize;
    //         $file->save();
    //         return 'yes';
    //     }
    //     File::create($request->all());
    //     return redirect('/index');
    //     // return $request->all();
    // }

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
