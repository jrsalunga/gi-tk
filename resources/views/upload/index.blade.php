@extends('master')

@section('title', '- Upload')



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

<p>this is a test</p>


{!! Form::open(array('url' => 'upload/')) !!}
    
{!! Form::close() !!}



<div class="dropbox-container">
	<div id="dropbox" class="prod-image">
		<span class="message">Drop file here to upload. <br />
		<i>(they will only be visible to you)</i>
		</span>
	</div>
	<label for="file_upload" class="lbl-file_upload">Upload</label> 
	<input type="file" id="file_upload" name="file_upload" style="display: none" />
</div>
<div class="dropbox-container2">
	<div id="dropbox2">
		<div style="text-align: center;">
		<span class="imageHolder">
		<img src="">
		<span class="uploaded"></span>
		</span>
		</div>
	</div>
</div>



@endsection


@section('js-external')
  @include('_partials.js-vendors')
  @include('_partials.js-upload')
@endsection