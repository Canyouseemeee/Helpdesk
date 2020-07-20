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
                <select name="Trackerid" id="Trackerid" class="form-control create">
                    <option value="">เลือกข้อมูล H/S </option>
                    @foreach($list as $row)
                        <option value="{{$row->Trackerid}}">{{$row->ISTName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Priority') !!}
                <select name="Priorityid" id="Priorityid" class="form-control create">
                    <option value="">เลือกระดับความสำคัญ</option>
                    @foreach($list2 as $row2)
                        <option value="{{$row2->Priorityid}}">{{$row2->ISPName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Status') !!}
                <select name="Statusid" id="Statusid" class="form-control create">
                    <option value="">เลือกสถานะของปัญหา</option>
                    @foreach($arealist as $arealist1)
                        <option value="{{$arealist1->Statusid}}">{{$arealist1->ISSName}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                {!! Form::label('Users') !!}
                {!! Form::text('users', Auth::user()->name ,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Subject') !!}
                {!! Form::text('subject',null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Description') !!}
                {!! Form::textarea('description',null,["class"=>"form-control",'rows' => 6, 'cols' => 60]) !!}
                
            </div>
                <input type="submit" value="บันทึก" class="btn btn-primary ">
                <a href="/index" class="btn btn-success">ย้อนกลับ</a>
            
        </div>
    {!! Form::close() !!}
    </div>
@endsection