@extends('masterfiles.employee.master')

@section('title', '- Employee View Record')

@section('body-class', 'employee-view')

@section('container-body')
  @parent

<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="row">
    
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/masterfiles">Masterfiles</a></li>
      <li><a href="/masterfiles/employee">Employee</a></li>
      <li class="active">{{ $employee->code }}</li>
    </ol>

    <nav id="nav-action" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-form">
          <div class="btn-group" role="group">
            <a href="/masterfiles/employee" class="btn btn-default">
              <span class="glyphicon glyphicon-th-list"></span>
            </a>
            <button type="button" href="/mastefiles/employee/add" class="btn btn-default active" >
              <span class="glyphicon glyphicon-file"></span>
            </button>
          </div>
          <div class="btn-group" role="group">
            <a href="/masterfiles/employee/add" class="btn btn-default">
              <span class="glyphicon glyphicon-plus"></span>
            </a>
            <a href="/masterfiles/employee/{{ $employee->id }}/edit" class="btn btn-default">
              <span class="glyphicon glyphicon-edit"></span>
            </a>
          </div>
          <div class="btn-group pull-right" role="group">
            @if($employee->previous()==='false')
              <a href="/masterfiles/employee" class="btn btn-default disabled">
            @else
              <a href="/masterfiles/employee/{{ strtolower($employee->previous()->id) }}" class="btn btn-default">
            @endif
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            @if($employee->next()==='false')
              <a href="/masterfiles/employee" class="btn btn-default disabled">
            @else
              <a href="/masterfiles/employee/{{ strtolower($employee->next()->id) }}" class="btn btn-default">
            @endif  
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div><!-- end right-nav-btn-grp -->
      </div>
    </nav>


    
    <div class="col-lg-9">
      <div class="row">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Info</a></li>
        <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact Details</a></li>
        <li role="presentation"><a href="#family" aria-controls="family" role="tab" data-toggle="tab">Background</a></li>
        <li role="presentation"><a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
      </ul>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="basic">
          <div class="tab-container">
            <div class="col-md-3">
              <div class="form-group">
                <label for="code" class="control-label">Man No.</label>
                <input type="text" class="form-control" value="{{ $employee->code }}" id="code" readonly>
              </div>
            </div> 
             
            <div class="col-md-3 col-md-offset-6">
              <div class="form-group">
                <label for="hired" class="control-label">Date Hired</label>
                <input type="text" class="form-control" id="hired" value="{{ $employee->hired }}" readonly>
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="firstname" class="control-label">Firstname</label>
                <input type="text" class="form-control" id="firstname" value="{{ $employee->firstname }}" readonly>
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="middlename" class="control-label">Middlename</label>
                <input type="text" class="form-control" id="middlename" value="{{ $employee->middlename }}" readonly>
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="lastname" class="control-label">Lastname</label>
                <input type="text" class="form-control" id="lastname" value="{{ $employee->lastname }}" readonly>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label for="suffix" class="control-label">Suffix</label>
                <input type="text" class="form-control" id="suffix" value="{{ $employee->suffix }}" readonly>
              </div>
            </div>   
            <div class="col-md-6">
              <div class="form-group">
                <label for="suffix" class="control-label">Branch</label>
                <input type="text" class="form-control" id="rfid" value="{{ $employee->branch->code }} - {{ $employee->branch->addr1 }}" readonly>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label for="rfid" class="control-label">RFID</label>
                <input type="text" class="form-control" id="rfid" value="{{ $employee->rfid }}" readonly>
              </div>
            </div>   
            <div class="clearfix"></div>
          </div>
        </div><!-- end basic -->
        <div role="tabpanel" class="tab-pane" id="contact">
          <div class="tab-container">

          </div>
        </div><!-- end contact -->
        <div role="tabpanel" class="tab-pane" id="family">
          <div class="tab-container">

          </div>
        </div><!-- end family -->
        <div role="tabpanel" class="tab-pane" id="others">
          <div class="tab-container">

          </div>
        </div><!-- end other -->
      </div><!-- end .tab-content --> 
      </div><!-- end .tab-content --> 
      </div><!-- end .col-md-9 --> 
      <div class="col-lg-3">
        <div style="border:1px dashed #ccc; width: 200px; height: 200px; margin: 0 auto 0 auto;">

        </div>
      </div>
    
      
    


   

  </div>
</div>
<!-- end main -->
</div>
@endsection


@section('js-external')
  @include('_partials.js-vendors')
  @include('_partials.js-upload')
@endsection