@extends('CA.racine_CA')
@section('head-section')


@endsection
@section('content')
<div style="margin-top: 5px">
<a href="{{ url()->previous() }}"> <button class="btn btn-primary"><i class="fa fa-arrow-left"></i> back</button> </a>
</div>

<div class="row">
  <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-primary" style=" margin-top: 15px;" >	
			<div class="panel-heading" align="center" >Création d'un agent</div>
			<div class="panel-body" style="height: 100%;"> 
				<div class="col-sm-12" >
					  {!! Form::open(['route' => 'agent.add', 'class' => 'form-horizontal panel']) !!}	
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}" >
						{!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'Prénom']) !!}
						{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('last_name') ? 'has-error' : '' !!}">
					  	{!! Form::text('last_name', null, ['class' => 'form-control ', 'placeholder' => 'Nom']) !!}
					  	{!! $errors->first('last_name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
					  	{!! Form::email('email', null, ['class' => 'form-control ', 'placeholder' => 'Email']) !!}
					  	{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>

	          	<input style="margin-right: 5px;" id="sub" type="submit" name="Add" class="btn btn-primary pull-right">
		
			
		
		
	       	{!! Form::close() !!}
	       </div>
	   </div>
	</div>
</div>
</div>

@endsection
