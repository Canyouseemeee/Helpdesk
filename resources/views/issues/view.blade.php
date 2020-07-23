@extends('layouts.app')
@section('content')
<style>
div.a {
    font-size: 150%;
}
</style>
<script>
  new FroalaEditor('textarea#froala-editor')
</script>

    {!! Form::open(['action' => ['IssuesController@show',$data->Issuesid],'method'=>'PUT']) !!}
    <div class="jumbotron" style="font-size:20px">
        <div class="form-row " >
            <div class="form-group col-md-2">
                <b>{!! Form::label('Tracker : ') !!}</b>
                @foreach($list as $row)
                    @if ($row->Trackerid === $data->Trackerid)
                        {!! Form::label($row->ISTName) !!}
                    @endif
                @endforeach  
            </div>
            
            <div class="form-group col-md-2">
            <b>{!! Form::label('Priority : ') !!}</b>
                @foreach($list2 as $row2)
                    @if ($row2->Priorityid === $data->Priorityid)
                        {!! Form::label($row2->ISPName) !!}
                    @endif
                @endforeach
            </div>

            <div class="form-group col-md-2">
            <b>{!! Form::label('Status : ') !!}</b>
                    @foreach($arealist as $row3)
                        @if ($row3->Statusid === $data->Statusid)
                            {!! Form::label($row3->ISSName) !!}
                        @endif
                    @endforeach
            </div>
        </div>
        <div class="form-row" >
            <div class="form-group col-md-3">
            <b>{!! Form::label('Category : ') !!}</b>
                    @foreach($arealist3 as $arealist3)
                        @if ($arealist3->Departmentid === $data->Departmentid)
                            {!! Form::label($arealist3->DmName) !!}
                        @endif
                    @endforeach
            </div>
           
            <div class="form-group col-md-2">
            <b>{!! Form::label('Users : ') !!}</b>
                {!! Form::label('users',$data->Users) !!}
            </div>
        </div>
        
            <div class="form-group" >
            <b>{!! Form::label('Subject :') !!}</b>
                {!! Form::label('subject',$data->Subject,['style'=>'word-break:break-all']) !!}
            </div>
            
            
            
            <div class="form-group" >
                <b>{!! Form::label('Description :') !!}</b>
                {!! Form::label('description',$data->Description,['style'=>'word-break:break-all']) !!}
            </div>


            <!-- <input type="submit" value="อัพเดท" class="btn btn-primary"> -->
            <a href="{{route('issues.edit',$data->Issuesid)}}" class="btn btn-primary">แก้ไข</a>
            <a href="/index" class="btn btn-success">ย้อนกลับ</a>
    </div>
    {!! Form::close() !!}
@endsection