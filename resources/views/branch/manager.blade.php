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
  <div class="row">
    <div class="page-header">
      <h3>Branch Information <small>Subtext for header</small></h3>
    </div>
    <div class="col-md-6">
      {!! Form::open(['url' => 'branch/manager', 'method' => 'post']) !!}

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



