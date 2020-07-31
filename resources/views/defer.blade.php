@extends('layouts.master2')
@section('content')
<?php 
// function datedisplay($sdate){
//   //echo $sdate;
//   $dd = substr($sdate,8,2);
//   $mm = substr($sdate,5,2);
//   $year = substr($sdate,0,4);
//   $time = substr($sdate,-9,3);
//   // $time->format('H:i');
//   if($dd!=00){
//    if($year<2500){$year = $year+543;}
//   }else{
//    //$dd = "00";$mm = "00";$year = "0000";
//    return "";
//   }
  
//   return $dd."/".$mm."/".$year." ".$time; 
//  }
 function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate))+7;
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
	}
?>

<?php
$mytime = Carbon\Carbon::now();
// echo $mytime->format('H:i');
?>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{$message}}</p>
</div>
@endif
<div class = "card">
  <div class="card-body">
    <div class="content">
      {!! Form::open(['method' => 'post', 'action' => 'IssuesController@getReport']) !!}
      <h2 align="center">ข้อมูลปัญหาที่ยังไม่เสร็จ</h2>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Filter') }}</div>
                    <div class="card-body row">
                      <div class="form-group row">
                        {!! Form::label('Fromdate:',null,["class"=>"col-md-4 col-form-label text-md-right"]) !!}
                        <div class="col-md-8">
                          {!! Form::date('fromdate',null,["class"=>"form-control datepicker","data-date-format"=>"mm/dd/yyyy","style"=>"text-align:center"]) !!}
                        </div>
                      </div>
                      <div class="form-group row">
                        {!! Form::label('Todate :',null,["class"=>"col-md-4 col-form-label text-md-right"]) !!}
                        <div class="col-md-8">
                          {!! Form::date('todate',null,["class"=>"form-control datepicker","style"=>"text-align:center"]) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 " align="center">
                          {!! Form::submit('Search', ['class' => 'col-md-12 btn btn-info']) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="container">
        <a href="/issues" class="btn btn-primary">แจ้งปัญหา</a>
      </div>
      {!! Form::close() !!}
      <table class="table ">
        <thead>
          <tr>
            <th scope="col" style="text-align:center">#</th>
            <th scope="col" style="text-align:center">Tracker</th>
            <th scope="col" style="text-align:center">Status</th>
            <th scope="col" style="text-align:center">Priority</th>
            <th scope="col" style="text-align:center">Users</th>
            <th scope="col" style="text-align:center">Subject</th>
            <th scope="col" style="text-align:center">Created</th>
            <th scope="col" style="text-align:center">Updated</th>
            <th scope="col"></th>
        </tr>
      </thead>
      @if (!is_null($list))
      <tbody>
        @foreach($list as $row)
          <tr>
          <th scope="row">{{$row->Issuesid}}</th>
          <td style="text-align:center">{{$row->ISTName}}</td>
          <td style="text-align:center">{{$row->ISSName}}</td>
          <td style="text-align:center">{{$row->ISPName}}</td>
          <td style="text-align:center">{{$row->Users}}</td>
          <td><a href="{{route('issues.show',$row->Issuesid)}}" width='300' class="style1" style='word-break:break-all'>{{$row->Subject}}</a></td>
          <td style="text-align:center">{{DateThai($row->created_at)}}</td>
          <td style="text-align:center">{{DateThai($row->updated_at)}}</td>
          <td>
            <a href="{{route('issues.show',$row->Issuesid)}}" class="btn btn-success">ดู</a>
          </td>
          </tr>
              <!-- <form action="{{route('issues.destroy',$row->Issuesid)}}" method="post">
                @csrf @method('DELETE')
                <input type="submit" value='ลบ' data-id="{{$row->Issuesid}}" class="btn btn-danger deleteForm">
              </form>
            </td> -->
        @endforeach
      @endif
        @if (!is_null($between))
            <tbody>
              @foreach ($between as $betweens)
              <tr>
                <th scope="row">{{$betweens->Issuesid}}</th>
                  <td style="text-align:center">{{$betweens->ISTName}}</td>
                  <td style="text-align:center">{{$betweens->ISSName}}</td>
                  <td style="text-align:center">{{$betweens->ISPName}}</td>
                  <td style="text-align:center">{{$betweens->Users}}</td>
                  <td><a href="{{route('issues.show',$betweens->Issuesid)}}" width='300' 
                  class="style1" style='word-break:break-all'>{{$betweens->Subject}}</a></td>
                  <td style="text-align:center">{{DateThai($betweens->created_at)}}</td>
                  <td style="text-align:center">{{DateThai($betweens->updated_at)}}</td>
                  <td>
                    <a href="{{route('issues.show',$betweens->Issuesid)}}" class="btn btn-success">ดู</a>
                  </td>
              </tr>
              @endforeach
            </tbody>
        @endif
      </tbody>
    </table>
    </div>
  </div>
</div>
@endsection
