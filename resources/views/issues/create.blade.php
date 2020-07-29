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
    {!! Form::open(['action' => 'IssuesController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-row">
        <div class="col-md-3">
            {!! Form::label('Tracker') !!}
            <select name="Trackerid" id="Trackerid" class="form-control create">
                @foreach($list as $row)
                    <option value="{{$row->Trackerid}}">{{$row->ISTName}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            {!! Form::label('Priority') !!}
            <select name="Priorityid" id="Priorityid" class="form-control create" >
                @foreach($list2 as $row2)
                    <option value="{{$row2->Priorityid}}"  
                    @if ($row2->Priorityid === 2)
                        selected
                    @endif>{{$row2->ISPName}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
                {!! Form::label('Status') !!}
                <select name="Statusid" id="Statusid" class="form-control create">
                    @foreach($arealist as $arealist1)
                        <option value="{{$arealist1->Statusid}}">{{$arealist1->ISSName}}</option>
                    @endforeach
                </select>
        </div>
        
        <div class="form-group col-md-3">
                {!! Form::label('Category') !!}
                <select name="Departmentid" id="Departmentid" class="form-control create">
                    @foreach($arealist3 as $arealist3)
                        <option value="{{$arealist3->Departmentid}}">{{$arealist3->DmName}}</option>
                    @endforeach
                </select>
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('Users') !!}
            {!! Form::text('users', Auth::user()->name ,["class"=>"form-control",'readonly'=>"readonly"]) !!}
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('Date') !!}
            {!! Form::text('Date_In',now()->toDateString(),["class"=>"form-control"]) !!}
        </div>
    </div>
        <div class="form-group">
            {!! Form::label('Subject') !!}
            {!! Form::text('subject',null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description',null,["class"=>"form-control",'rows' => 6, 'cols' => 60 , 'id'=>"summernote"]) !!}
        </div>

        <div>
            <input type="file" name="fileupload1" id="fileupload1">
            @csrf
        </div>
            <br>
            <input type="submit" value="บันทึก" class="btn btn-primary ">
            <a href="/index" class="btn btn-success">ย้อนกลับ</a>
    {!! Form::close() !!}
    </div>
@endsection
