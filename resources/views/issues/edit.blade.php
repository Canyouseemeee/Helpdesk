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
    {!! Form::open(['action' => ['IssuesController@update',$data->id],'method'=>'PUT']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('Tracker') !!}
                <select name="Trackerid" id="Trackerid" class="form-control create">
                    
                    @foreach($list as $row)
                        <option value="{{$row->id}}"
                        @if ($row->id === $data->Trackerid)
                            selected
                        @endif
                        >{{$row->ISTName}}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Priority') !!}
                <select name="Priorityid" id="Priorityid" class="form-control create">
                
                    
                    @foreach($list2 as $row2)
                        <option value="{{$row2->id}}"
                        @if ($row2->id === $data->Priorityid)
                            selected
                        @endif
                        >{{$row2->ISPName}}</option>
                    @endforeach
                
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('Status') !!}
                <select name="Statusid" id="Statusid" class="form-control create">
               
                   
                    @foreach($arealist as $row3)
                        <option value="{{$row3->id}}"
                        @if ($row3->id === $data->Statusid)
                            selected
                        @endif
                        >{{$row3->ISSName}}</option>
                    @endforeach
                
                </select>
            </div>
            
            <div class="form-group">
                {!! Form::label('Users') !!}
                {!! Form::text('users',$data->Users,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Subject') !!}
                {!! Form::text('subject',$data->Subject,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Description') !!}
                {!! Form::textarea('description',$data->Description,["class"=>"form-control",'rows' => 6, 'cols' => 60]) !!}
            </div>

            <input type="submit" value="อัพเดท" class="btn btn-primary">
            <a href="/index" class="btn btn-success">ย้อนกลับ</a>
        </div>
    {!! Form::close() !!}
    </div>
@endsection