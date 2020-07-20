@extends('layouts.app')
@section('content')
<?php 
  // echo print_r($list);
?>

    <div class="container">
        <h2 align="center">ข้อมูลปัญหา</h2>
        <a href="/issues" class="btn btn-primary">แจ้งปัญหา</a>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tracker</th>
      <th scope="col">Priority</th>
      <th scope="col">Status</th>
      <th scope="col">Users</th>
      <th scope="col">Subject</th>
      <th scope="col">Description</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $row)
        <tr>
        <th scope="row">{{$row->Issuesid}}</th>
        <td>{{$row->ISTName}}</td>
        <td>{{$row->ISPName}}</td>
        <td>{{$row->ISSName}}</td>
        <td>{{$row->Users}}</td>
        <td>{{$row->Subject}}</td>
        <td>{{$row->Description}}</td>
        <td>
          <a href="{{route('issues.edit',$row->Issuesid)}}" class="btn btn-success">แก้ไข</a>
        </td>
        <td>
          <form action="{{route('issues.destroy',$row->Issuesid)}}" method="post">
            @csrf @method('DELETE')
            <input type="submit" value='ลบ' data-id="{{$row->Issuesid}}" class="btn btn-danger deleteForm">
          </form>
        </td>
        </tr>
    @endforeach
  </tbody>
</table>
    </div>
@endsection