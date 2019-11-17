@extends('Siege.racine')
@section('head-section')
 <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<script>
		$(document).ready(function(){
				$('#start-logo').css('transform', 'rotate(720deg)');
				setTimeout(function(){
					$('#start-logo').css({'width':'9%','height':'19%', 'opacity':'0','margin-top':'23%'});
				}
				,700);

				setTimeout(function(){
					$('#start-logo').css({'display':'none'});
					$("#welcome-card").css({'display':'block', 'opacity':'1','margin-top':'20%'});
				}
				,1500);
		});
	</script>




@endsection

@section('content')
<div id="start-logo-container" style="width:100%;height:100%;">
	<img id="start-logo" src="template/img/arroser.jpg">
</div>

<div id="welcome-card" class="">
	<div id="welcome-card-title">
		Bienvenue {!! auth::user()->name !!}
	</div>
	<div id="welcome-card-text">
		Authentification passé avec succés!<br  />
		Sélectionnez un élément dans le menu de navigation à gauche pour commencer.

	</div>
</div>

@endsection