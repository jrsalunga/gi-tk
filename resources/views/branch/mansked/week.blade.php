@extends('branch.master')

@section('title', '- Weekly Man Sched')

@section('body-class', 'mansked-week')

@section('container-body')
  <div class="container-fluid">
<!-- sidebar -->
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li><a href="/branch/manage/user">Manage User</a></li>
    <li><a href="/masterfiles/employee">Employee</a></li>
    <li class="active"><a href="/branch/mansked">Man Schedule</a></li>
  </ul>    
</div>

<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="row">
    
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/branch">Branch</a></li>
      <li><a href="/branch/mansked">Man Schedule</a></li>
      <li class="active">Week</li>
    </ol>

    <nav id="nav-action" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-form">
          <div class="btn-group" role="group">
            <a href="/branch/mansked" class="btn btn-default">
              <span class="glyphicon glyphicon-th-list"></span>
            </a> 
            <button type="button" class="btn btn-default active">
              <span class="glyphicon glyphicon-calendar"></span>
            </button>
            <a href="/masterfiles/employee/" class="btn btn-default">
              <span class="glyphicon glyphicon-file"></span>
            </a>   
          </div>
      </div><!-- end btn-grp -->
      </div>
    </nav>

    <table class="table tb-mansked-week">
      <tbody>
    <?php

    /*
    for($j=0; $j<=8; $j++){
      echo '<tr>';
      for($i=0; $i<=6; $i++){
          if($i==1 || $i==2 || $i==6)
            continue;
          else if($j==8)
            continue;
            //echo '<td>'. $mansked[$j-1]['created'] .'</td>';
          else 
            echo '<td>'. $mansked[$j][$i] .'</td>';
      }
      
      echo '</tr>';
    }
    */


    
    for($i=0; $i<=7; $i++){

      echo '<tr>';
      for($j=0; $j<=7; $j++){
          if($i==1 || $i==2 || $i==6)
            continue;
          else if($i==7 && $j!=0)
            if($mansked[$j]['created']=='true')
              echo '<td><a class="btn btn-default" href="/branch/manday/'.strtolower($mansked[$j]['id']).'/edit"><i class="fa fa-calendar-plus-o"></i>
</a></td>';
            else
              echo '<td><a href="#">'. $mansked[$j]['created'] .'</a></td>';
          else if($i==0 && $j!=0)
                echo '<td>'. date('M j',strtotime($mansked[$j][$i])) .'</td>';
          else 
            echo '<td>'. $mansked[$j][$i] .'</td>';
      }
      echo '</tr>';
    }
    
    ?>
      </tbody>
    </table>


    
      
  </div>
</div>

<!-- end main -->
</div>
@endsection


