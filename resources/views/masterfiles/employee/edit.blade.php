@extends('masterfiles.employee.master')

@section('title', '- Employee Edit Record')

@section('body-class', 'employee-edit')

@section('container-body')
  @parent

<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="row">
    
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/masterfiles">Masterfiles</a></li>
      <li><a href="/masterfiles/employee">Employee</a></li>
      <li><a href="/masterfiles/employee/{{ strtolower($employee->id)}}">{{ $employee->code }}</a></li>
      <li class="active">Edit Record</li>
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


    {!! Form::open(['method'=>'PUT', 'url' => 'api/t/employee', 'accept-charset'=>'utf-8', 'id'=>'frm-employee', 'name'=>'frm-employee', 'class'=>'table-model']) !!}
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
                <input type="hidden" value="{{ $employee->id }}" name="id" id="id">
              </div>
            </div> 
             
            <div class="col-md-3 col-md-offset-6">
              <div class="form-group">
                <label for="hired" class="control-label">Date Hired</label>
                <input type="text" class="form-control" name="hired" id="hired" value="{{ $employee->hired }}" >
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="firstname" class="control-label">Firstname</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $employee->firstname }}" >
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="middlename" class="control-label">Middlename</label>
                <input type="text" class="form-control" name="middlename" id="middlename" value="{{ $employee->middlename }}" >
              </div>
            </div>   
            <div class="col-md-3">
              <div class="form-group">
                <label for="lastname" class="control-label">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $employee->lastname }}" >
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label for="suffix" class="control-label">Suffix</label>
                <input type="text" class="form-control" name="suffix" id="suffix" value="{{ $employee->suffix }}" >
              </div>
            </div>   
            <div class="col-md-6">
              <div class="form-group">
                <label for="suffix" class="control-label">Branch</label>
                <select class="form-control" name="branchid" id="branchid" placeholder="Select">
                  @foreach($branches as $branch)
                    @if($branch->id == $employee->branchid)
                      <option selected value="{{ $branch->id }}">{{ $branch->code }} - {{ $branch->addr1 }}</option>
                    @else
                      <option value="{{ $branch->id }}">{{ $branch->code }} - {{ $branch->addr1 }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label for="rfid" class="control-label">RFID</label>
                <input type="text" class="form-control" name="rfid" id="rfid" value="{{ $employee->rfid }}">
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
    
      <div class="col-md-9">
        
          <a href="{{ isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/masterfiles/employee' }}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-primary">Save</button>
      
      </div>
    {!! Form::close() !!}


   

  </div>
</div>
<!-- end main -->
</div>
@endsection


@section('js-external')
  @include('_partials.js-vendors')
  @include('_partials.js-upload')
@endsection