<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
	<title>Giligan's Restaurant Timeleeping </title>
	
	<link rel="stylesheet" href="/css/styles-all.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    	<!--
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    -->
      <a class="navbar-brand" href="/">Giligan's Restaurant</a>
    </div>
    <div>
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
      <p class="navbar-text navbar-right"><span class="glyphicon glyphicon-time"></span> Timekeeping</p>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<!-- end Fixed navbar -->


<div class="container-fluid">
	<div class="tk-block row">
		<div class="l-pane col-sm-5">
      
      <div class="ts-group">
              
        <div class="ts">{{  strftime('%I:%M:%S', strtotime('now')) }}</div>
        <div class="am">{{  strftime('%p', strtotime('now')) }}</div>
        <div style="clear: both;"></div>
               
      </div>
      
      <div class="date-group">
        <div id="date">
          <span class="glyphicon glyphicon-calendar"> </span>       
          <time>{{  date('F j, Y', strtotime('now')) }}</time>
          
        </div>
        <div>
          <span>
            <span class="day">{{  date('l', strtotime('now')) }}</span>
          </span>
        </div>
      </div>

      <div class="emp-group">
        <div class="img-cont">
          <img  id="emp-img" src="/images/employees/{{ $timelogs[0]->employee->code }}.jpg" height="140px" width="140px" >
        </div>
        <div class="emp-cont">
          <p id="emp-code">{{ $timelogs[0]->employee->code }}</p>
          <h1 id="emp-name">{{ $timelogs[0]->employee->lastname }}, {{ $timelogs[0]->employee->firstname }}</h1>
          <p id="emp-pos">{{ $timelogs[0]->employee->position }}</p>
        </div>
        <div style="clear: both;"></div>
      </div>
      
      <div class="message-group"></div>
      
      

		</div>
		<div class="r-pane col-sm-7">
      <div class="container-table">
        <table class="table table-condensed" role="table">
          <thead>
            <tr>
              <th>Emp No</th><th>Name</th><th>Date Time</th><th>Type</th><th>Branch</th>
            </tr>
          </thead>
          <tbody class="emp-tk-list">
            @foreach($timelogs as $timelog)
            <tr class="{{ $timelog->txncode }}">
              <td>{{ $timelog->employee->code }}</td>
              <td>{{ $timelog->employee->lastname }}, {{ $timelog->employee->firstname }}</td>
              <td>
                <span>
                  {{ strftime('%b %d', strtotime($timelog->datetime)) }}
                </span>
                &nbsp;
                {{ strftime('%I:%M:%S %p', strtotime($timelog->datetime)) }}
              </td>
              <td>
                {{ $timelog->txncode == 'ti' ? 'Time In ': 'Time Out ' }}   
              </td>
              <td>
                {{ $timelog->employee->branch->code }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
		</div>
	</div>	
</div>


<!-- modal ti/to -->	
<div class="modal fade" id="TKModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Good day!</h4>
      </div>
      <div class="modal-body">
        <div class="emp-group">
        <div class="img-cont">
          <img  id="mdl-emp-img" src="" height="140px" width="140px" >
        </div>
        <div class="emp-cont">
          <p id="mdl-emp-code"></p>
          <h1 id="mdl-emp-name"></h1>
          <p id="mdl-emp-pos"></p>
        </div>
        <div style="clear: both;"></div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-time-in" class="btn btn-primary" data-dismiss="modal">
          press <strong>F</strong> for Time In
        </button>
        <button type="button" id="btn-time-out" class="btn btn-warning" data-dismiss="modal">press <strong>J</strong> for Time Out</button>
        
      </div>
        <div class="mdl-f-options">
          <p>Options:</p>
          <button type="button" class="btn btn-info btn-xs">press <strong>T</strong> to view timelog for the current month</button>
        <button type="button" class="btn btn-default btn-xs">press <strong>Esc</strong> to escape</button>
        </div>
    </div>
  </div>
</div>
<!-- end modal ti/to -->


  <!--
  <script src="/js/vendors/jquery-1.11.3.min.js"></script>
  <script src="/js/vendors/jquery-ui-1.11.3.min.js"></script>
  <script src="/js/vendors/bootstrap-3.3.5.min.js"></script>
  <script src="/js/vendors/moment-2.10.6.min.js"></script>
  -->
  <script src="/js/vendors-all.js"></script>
  <script src="/js/tk.js"></script>
	

	



</body>
</html>