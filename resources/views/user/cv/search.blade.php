@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>CV List</h2>
      </div>
      <div class="col-md-6">
        <div class="navbar-header" style="float: right !important; margin-top: 22px;">
            <ol class="breadcrumb hidden-xs">
              <li class="active">
                <a href="/admin"></i> Home</a>
              </li>                                 
              <li>View CV</li> 
            </ol>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <table class="table table-responsive">
        <thead>
          <tr>
            <th>Job ID</th>
            <th>Attachment</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cvs as $cv)
          <tr>
            <td>{{$cv['job_id']}}</td>
            <td>{{$cv['attachment']}}</td>
            <td style="width: 300px;">
              <a style="float: left; margin-right: 5px;" href="/job/{{$cv->job_id}}/cv/{{$cv->id}}/edit" class="btn btn-warning">Edit</a>
              <form action="/job/{{$cv->job_id}}/cv/{{$cv->id}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection