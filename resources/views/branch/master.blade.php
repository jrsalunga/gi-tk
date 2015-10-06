@extends('master')

@section('title', '- master')



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
<ul class="nav navbar-nav navbar-right"> 
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-cog"></span>
            <b class="caret"></b>
        </a>
            <ul class="dropdown-menu">
              <li><a href="/settings">Settings</a></li>
              <li><a href="/logout">Log Out</a></li>     
          </ul>
    </li>
</ul>
@endsection




@section('container-body')
<div class="container-fluid">
<!-- sidebar -->
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li>
      <a href="/branch/manage/user">Manage User</a>
    </li>
    <li>
      <a href="/branch/mansked">Man Sched</a>
    </li>
  </ul>    
</div>
<!-- end sidebar -->




@endsection


@section('js-external')
  
  @if(app()->environment() == 'local')
    @include('_partials.js-vendors')
  @else 
    @include('_partials.js-vendors-common-min')
  @endif



  
@endsection