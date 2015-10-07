@extends('masterfiles.employee.master')

@section('title', '- Employee List')

@section('body-class', 'employee-list')

@section('container-body')
  @parent

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
            <button type="button" class="btn btn-default active">
              <span class="glyphicon glyphicon-th-list"></span>
            </button>
            <a href="/masterfiles/employee/{{ strtolower($employees[0]->id) }}" class="btn btn-default">
              <span class="glyphicon glyphicon-file"></span>
            </a>   
          </div>

          <div class="btn-group" role="group">
            <a href="/masterfiles/employee/add" class="btn btn-default">
              <span class="glyphicon glyphicon-plus"></span>
            </a>
          </div>
      </div><!-- end btn-grp -->
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
        <td>{{ strlen($employee->position)==0?'':$employee->position->descriptor }}</td>
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


