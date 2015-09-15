<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
	<title>Giligan's Restaurant Timekeeping @yield('title')</title>
	
	<link rel="stylesheet" href="/css/normalize-3.0.3.min.css">
	<link rel="stylesheet" href="/css/bootstrap-3.3.5.min.css">
	<link rel="stylesheet" href="/css/bt-override.css">
	<link rel="stylesheet" href="/css/styles.css">

  <meta name="csrf-token" content="{{ csrf_token() }}" />


</head>
<body>
<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    	
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    
      <a class="navbar-brand" href="/">Giligan's Restaurant</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      @yield('navbar-1')
      @yield('navbar-2')
    </div>
  </div>
</nav>

@section('container-body')


@show



@section('js-external')

@show


</body>
</html>