@extends('layouts.app')
@section('content')
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
    @foreach($data as $row)
        @foreach($list as $row2)
        <tr>
        <th scope="row">{{$row->id}}</th>
        <td>{{$row2->ISTName}}</td>
        <td>{{$row->Priority}}</td>
        <td>{{$row->Status}}</td>
        <td>{{$row->Users}}</td>
        <td>{{$row->Subject}}</td>
        <td>{{$row->Description}}</td>
        <td>
          <a href="/issues" class="btn btn-success">แก้ไข</a>
        </td>
        <td>
          <a href="/index" class="btn btn-danger">ลบ</a>
        </td>
        </tr>
        @endforeach
    @endforeach
  </tbody>
</table>
    </div>
@endsection