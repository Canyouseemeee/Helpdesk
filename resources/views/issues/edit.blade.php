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
    {!! Form::open(['action' => ['IssuesController@update',$data->Issuesid],'method'=>'PUT']) !!}
    <div class="form-row">
        <div class="form-group col-md-3">
                {!! Form::label('Tracker') !!}
                <select name="Trackerid" id="Trackerid" class="form-control create"> 
                    @foreach($list as $row)
                        <option value="{{$row->Trackerid}}"
                        @if ($row->Trackerid === $data->Trackerid)
                            selected
                        @endif
                        >{{$row->ISTName}}</option>
                    @endforeach   
                </select>
        </div>

        <div class="form-group col-md-3">
                {!! Form::label('Priority') !!}
                <select name="Priorityid" id="Priorityid" class="form-control create">
                    @foreach($list2 as $row2)
                        <option value="{{$row2->Priorityid}}"
                        @if ($row2->Priorityid === $data->Priorityid)
                            selected
                        @endif
                        >{{$row2->ISPName}}</option>
                    @endforeach
                </select>
        </div>

        <div class="form-group col-md-3">
                {!! Form::label('Status') !!}
                <select name="Statusid" id="Statusid" class="form-control create">
                    @foreach($arealist as $row3)
                        <option value="{{$row3->Statusid}}"
                        @if ($row3->Statusid === $data->Statusid)
                            selected
                        @endif
                        >{{$row3->ISSName}}</option>
                    @endforeach
                </select>
        </div>

        <div class="form-group col-md-3">
                {!! Form::label('Category') !!}
                <select name="Departmentid" id="Departmentid" class="form-control create">
                    @foreach($arealist3 as $arealist3)
                    <option value="{{$arealist3->Departmentid}}"
                        @if ($arealist3->Departmentid === $data->Departmentid)
                            selected
                        @endif
                        >{{$arealist3->DmName}}</option>
                    @endforeach
                </select>
        </div>
            
        <div class="form-group col-md-3">
            {!! Form::label('Users') !!}
            {!! Form::text('users',$data->Users,["class"=>"form-control",'readonly'=>"readonly"]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Subject') !!}
        {!! Form::text('subject',$data->Subject,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Description') !!}
        {!! Form::textarea('description',$data->created_at,["class"=>"form-control",'rows' => 6, 'cols' => 60]) !!}
    </div>
    
    <input href="$data->Issuesid" type="submit" value="อัพเดท" class="btn btn-primary">
    <a href="{{route('issues.show',$data->Issuesid)}}" class="btn btn-success">ย้อนกลับ</a>
        
    {!! Form::close() !!}
@endsection