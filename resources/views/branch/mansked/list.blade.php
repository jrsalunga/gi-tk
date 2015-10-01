@extends('branch.master')

@section('title', '- Man Schedule')

@section('body-class', 'branch-mansked')

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
      <li class="active">Man Schedule</li>
    </ol>

    <nav id="nav-action" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-form">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default active">
              <span class="glyphicon glyphicon-th-list"></span>
            </button>
            <a href="/masterfiles/employee/" class="btn btn-default">
              <span class="glyphicon glyphicon-file"></span>
            </a>   
          </div>

          <div class="btn-group" role="group">
            <a href="/branch/mansked/add" class="btn btn-default">
              <span class="glyphicon glyphicon-plus"></span>
            </a>
          </div>
      </div><!-- end btn-grp -->
      </div>
    </nav>

    <table class="table table-condensed tb-brand">
    <thead>
      <tr>
        <th>Week</th>
        <th>Descriptor</th>  
      <tr>
    </thead>
    <tbody class=''>
      @foreach($weeks as $week)
      <tr>

        <td>{{ $week['week'] }}</td>
        <td></td>
      </tr>
      @endforeach
      
      
    </tbody>
    </table>
      {!! $weeks->render() !!}

    
      
  </div>
</div>

<!-- end main -->
</div>
@endsection

