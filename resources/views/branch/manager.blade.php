@extends('master')

@section('title', '- Branch Manager')
@section('body-class', 'jumbo')


@section('navbar-1')
<!--
<ul class="nav navbar-nav">
  <li class="active"><a href="#">Home</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="#contact">Contact</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Action</a></li>
      <li><a href="#">Another action</a></li>
      <li><a href="#">Something else here</a></li>
      <li role="separator" class="divider"></li>
      <li class="dropdown-header">Nav header</li>
      <li><a href="#">Separated link</a></li>
      <li><a href="#">One more separated link</a></li>
    </ul>
  </li>
</ul>
-->
@endsection

@section('navbar-2')

@endsection




@section('container-body')
<div class="container">

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="row">
    <div class="page-header">
      <h3>Branch User Information <small></small></h3>
    </div>
    <div class="col-md-6">
      {!! Form::open(['url' => 'branch/manager', 'method' => 'post']) !!}
      <div class="panel panel-default">
        <div class="panel-heading">Login Information</div>
        <div class="panel-body row">
          <div class="col-md-9">
          <div class="form-group">
            <label for="email" class="control-label">Email Address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" >
          </div>
        </div>   
        <div class="col-md-9">
          <div class="form-group">
            <label for="password1" class="control-label">Password</label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
          </div>
        </div>   
        <div class="col-md-9">
          <div class="form-group">
            <label for="password2" class="control-label">Verify Password</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Verify Password">
          </div>
        </div>  
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Personal Information</div>
        <div class="panel-body row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="code" class="control-label">Man No</label>
            <input type="text" class="form-control" id="code" name="code" placeholder="000000" >
          </div>
        </div>   
        <div class="col-md-9">
          <div class="form-group">
            <label for="firstname" class="control-label">Firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" >
          </div>
        </div>   
        <div class="col-md-9">
          <div class="form-group">
            <label for="middlename" class="control-label">Middlename</label>
            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middlename" >
          </div>
        </div>   
        <div class="col-md-9">
          <div class="form-group">
            <label for="lastname" class="control-label">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" >
          </div>
        </div>  
        
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">Branch Information</div>
      <div class="panel-body row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="suffix" class="control-label">Position</label>
            <select class="form-control" id="positionid" name="positionid">
              @foreach($postions as $postion)
                <option value="{{ $postion->id }}">{{ $postion->descriptor }}</option>
              @endforeach
            </select>
          </div>
        </div> 
        <div class="col-md-9">
          <div class="form-group">
            <label for="suffix" class="control-label">Branch</label>
            <select class="form-control" id="branchid" name="branchid">
              @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->code }} - {{ $branch->addr1 }}</option>
              @endforeach
            </select>
            <input type="hidden" name="ilat" id="ilat">
            <input type="hidden" name="ilong" id="ilong">
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="long" id="long">
          </div>
        </div> 
      </div>
    </div>


      <div class="g-recaptcha" data-sitekey="6LeTAg0TAAAAAGQjI2QJ0E3XId7p5nDO9dOPovQm"></div>


      {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
    <div class="col-md-6">
      <div id="map" class="img-loc"></div>
      <div class="loc-info"></div>
    </div>
  </div>
</div>
@endsection


@section('js-external')
  
  <script src="/js/vendors-all.js"></script>
  <script src="/js/tk.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjNiaRtUU5cE7G2IcIYVGm5vxyNDzh6ws&signed_in=true&callback=initMap"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>




@endsection



