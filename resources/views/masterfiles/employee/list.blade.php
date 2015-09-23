@extends('master')

@section('title', '- Employee List')

@section('body-class', 'employee-list')

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
    <li class="active">
      <a href="/masterfiles/employee">Employee</a>
    </li>
  </ul>    
</div>
<!-- end sidebar -->

<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="row">
    
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/masterfiles">Masterfiles</a></li>
      <li class="active">Employee</li>
    </ol>

    <nav id="nav-action" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-form">
          <div class="btn-group" role="group">
            <a href="/masterfiles/employee/add" class="btn btn-default">
              <span class="glyphicon glyphicon-plus"></span>
            </a>
          </div>
        
          <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-default active">
              <span class="glyphicon glyphicon-th-list"></span>
            </button>
            <a href="/masterfiles/employee/{{ strtolower($employees[0]->id) }}" class="btn btn-default">
              <span class="glyphicon glyphicon-file"></span>
            </a>   
          </div>
      </div><!-- end right-nav-btn-grp -->
      </div>
    </nav>



    <table class="table table-condensed tb-brand">
    <thead>
      <tr>
        <th>Code</th>
        <th>Lastname</th>  
        <th>Firstname</th>
        <th>Branch Code</th>
        <th>Position</th>
      <tr>
    </thead>
    <tbody class=''>
      @foreach($employees as $employee)
      <tr>
        <td><a href="/masterfiles/employee/{{ strtolower($employee->id) }}">{{ $employee->code }}</a></td>
        <td>{{ $employee->lastname }}</td>
        <td>{{ $employee->firstname }}</td>
        <td>{{ $employee->branch->code }}</td>
        <td>{{ $employee->position }}</td>
      </tr>
      @endforeach
      
      
    </tbody>
    </table>
      {!! $employees->render() !!}

  </div>
</div>
<!-- end main -->
</div>
@endsection


@section('js-external')
  @include('_partials.js-vendors')
  @include('_partials.js-upload')
@endsection