@extends('admin.layouts.app')

@section('content')
<div class="container">
  <h2>CV form</h2>
  <form method="post" action="/job/{{$job_id}}/cv" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Job ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="job_id" name="" value="{{$job_id}}" disabled="">
        <input type="text" class="form-control form-control-lg" placeholder="job_id" name="job_id" value="{{$job_id}}" style="display: none;">
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
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Attachment</label>
      <div class="col-sm-10">
        <span class="control-fileupload">
          <input class="form-control" type="file" id="file" name="attachment">
        </span>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>

@endsection
<script type="text/javascript">
  $(function() {
    $('input[type=file]').change(function(){
      var t = $(this).val();
      var labelText = 'File : ' + t.substr(12, t.length);
      $(this).prev('label').text(labelText);
    })
  });
</script>