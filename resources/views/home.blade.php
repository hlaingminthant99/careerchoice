@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-left: 20px;">
        <form action="/search" method="POST" role="search">
        	{{ csrf_field() }}
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 90%" name="q">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="row">
    	<div class="container">
		    @if(isset($details))
		    <table class="table table-striped">
		        <thead>
		          <tr>
		            <th>Job Name</th>
		            <th>Job Type</th>
		            <th>Salary</th>
		          </tr>
		        </thead>
		        <tbody>
		          @foreach($details as $job)
		          <tr>
		            <td> {{$job['job_name']}}</td>
		            <td>{{$job['job_type']}}</td>
		            <td>{{$job['salary']}}</td>
		          </tr>
		          @endforeach
		        </tbody>
		    </table>
		    @endif
		</div>
    </div>
</div>
@endsection