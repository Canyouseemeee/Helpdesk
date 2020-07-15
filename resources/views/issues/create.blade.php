@extends('layouts.app')
@section('content')
    <div class="container">
    @if ($errors->all())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
               <li>
                  {{$error}}
               </li>
            @endforeach
        </ul>
    @endif
    {!! Form::open(['action' => 'IssuesController@store','method'=>'POST']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('Tracker') !!}
                <select name="Tracker" id="Tracker" class="form-control create">
                    <option value="">เลือกข้อมูล H/S </option>
                    @foreach($list as $row)
                        <option value="{{$row->id}}">{{$row->ISTName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Priority') !!}
                <select name="Priority" id="Priority" class="form-control create">
                    <option value="">เลือกระดับความสำคัญ</option>
                    @foreach($list2 as $row2)
                        <option value="{{$row2->issues_priority_ID}}">{{$row2->ISPName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Status') !!}
                <select name="Status" id="Status" class="form-control create">
                    <option value="">เลือกสถานะของปัญหา</option>
                    @foreach($arealist as $arealist1)
                        <option value="{{$arealist1->Issues_Status_ID}}">{{$arealist1->ISSName}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                {!! Form::label('Users') !!}
                {!! Form::text('users',null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Subject') !!}
                {!! Form::text('subject',null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Description') !!}
                {!! Form::text('description',null,["class"=>"form-control"]) !!}
            </div>

            

            <input type="submit" value="บันทึก" class="btn btn-primary">
            <a href="/index" class="btn btn-success">ย้อนกลับ</a>
        </div>
    {!! Form::close() !!}
    </div>
@endsection