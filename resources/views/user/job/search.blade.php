@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Job List</h2>
      </div>
      <div class="col-md-6">
        <div class="navbar-header" style="float: right !important; margin-top: 22px;">
            <ol class="breadcrumb hidden-xs">
              <li class="active">
                <a href="/admin"></i>Home</a>
              </li>                                 
              <li>Search Job</li> 
            </ol>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <table class="table table-responsive">
        <thead>
          <tr>
            <th>Job Name</th>
            <th>Job Type</th>
            <th>Salary</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jobs as $job)
          <tr>
            <td>{{$job['job_name']}}</td>
            <td>{{$job['job_type']}}</td>
            <td>{{$job['salary']}}</td>
            <td style="width: 300px;">
              <a style="float: left; margin-right: 5px;" href="{{action('UserCvController@create', $job->id)}}" class="btn btn-primary">Upload CV</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection