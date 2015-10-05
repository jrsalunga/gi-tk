@extends('branch.master')

@section('title', '- Create Daily Man Schedule')

@section('body-class', 'mansked-create')

@section('container-body')
  <div class="container-fluid">
<!-- sidebar -->
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li>
      <a href="/branch/manage/user">Manage User</a>
    </li>
    <li class="active">
      <a href="/branch/mansked">Man Schedule</a>
    </li>
  </ul>    
</div>

<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="row">
    
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/branch">Branch</a></li>
      <li><a href="/branch/manday">Daily Man Schedule</a></li>
      <li class="active">Add</li>
    </ol>

    <nav id="nav-action" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-form">
          <div class="btn-group" role="group">
            <a href="/branch/manday" class="btn btn-default">
              <span class="glyphicon glyphicon-th-list"></span>
            </a>
            <button type="button" class="btn btn-default active">
              <span class="glyphicon glyphicon-file"></span>
            </button>   
          </div>
      </div><!-- end btn-grp -->
      </div>
    </nav>



    
      
  </div>
</div>

<!-- end main -->
</div>
@endsection


