@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{$message}}</p>
</div>
@endif

    <div class="container">
        <h2 align="center">ข้อมูลปัญหา</h2>
        <a href="/issues" class="btn btn-primary">แจ้งปัญหา</a>
        <table class="table table-striped">
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
  <tbody>
    @foreach($list as $row)
        <tr>
        <th scope="row">{{$row->Issuesid}}</th>
        <td style="text-align:center">{{$row->ISTName}}</td>
        <td style="text-align:center">{{$row->ISSName}}</td>
        <td style="text-align:center">{{$row->ISPName}}</td>
        <td style="text-align:center">{{$row->Users}}</td>
        <td width='400' class="style1" style='word-break:break-all'>{{$row->Subject}}</td>
        <td style="text-align:center">{{$row->created_at}}</td>
        <td style="text-align:center">{{$row->updated_at}}</td>
        <td>
          <a href="{{route('issues.show',$row->Issuesid)}}" class="btn btn-success">ดู</a>
        </td>
        <!-- <td>
          <a href="{{route('issues.edit',$row->Issuesid)}}" class="btn btn-success">แก้ไข</a>
        </td> -->
        <!-- <td>
          <form action="{{route('issues.destroy',$row->Issuesid)}}" method="post">
            @csrf @method('DELETE')
            <input type="submit" value='ลบ' data-id="{{$row->Issuesid}}" class="btn btn-danger deleteForm">
          </form>
        </td> -->
        </tr>
    @endforeach
    
  </tbody>
</table>
    <div>
    {{$list->links()}}
    </div>
    </div>
@endsection