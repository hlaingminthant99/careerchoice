@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>Job Form</h2>
    </div>
    <div class="col-md-6">
      <div class="navbar-header" style="float: right !important; margin-top: 22px;">
          <ol class="breadcrumb hidden-xs">
            <li class="active">
              <a href="/home"></i>Home</a>
            </li>                                 
            <li>Create Job</li> 
          </ol>
      </div>
    </div>
  </div>
  <form method="post" action="{{url('job')}}">
    <div class="form-group row">
      {{csrf_field()}}
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Job Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="job_name" name="job_name">
      </div>
    </div>
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Job Type</label>
      <div class="col-sm-10">
        <select class="form-control form-control-lg" id="job_type" name="job_type">
          <option>Full Time</option>
          <option>Part Time</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Salary</label>
      <div class="col-sm-10">
        <select class="form-control form-control-lg" id="salary" name="salary">
          <option>100$-200$</option>
          <option>200$-300$</option>
          <option>200$-300$</option>
          <option>400$-500$</option>
          <option>500$+</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">User ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="user_id" name="user_id" value="{{$id}}" disabled="">
        <input type="text" class="form-control form-control-lg" placeholder="user_id" name="user_id" value="{{$id}}" style="display: none;">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Job Discription</label>
      <div class="col-sm-10">
        <textarea name="job_discription" rows=4 cols="80"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Job Location</label>
      <div class="col-sm-10">
        <textarea name="job_location" rows=4 cols="80"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Requirement</label>
      <div class="col-sm-10">
        <textarea name="requirement" rows=4 cols="80"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>

@endsection