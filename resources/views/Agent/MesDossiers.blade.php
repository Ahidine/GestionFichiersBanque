@extends('Agent.racine_agence')
@section('head-section')
<script type="text/javascript">
  function marqued($id_dossier)
  {
    //id_dossier joue pas de chose ici 
    $date =document.getElementById($id_dossier).value;
    if ($date=='') {
      $(".erreurdate").attr("style", "display: bloc")
      $("."+$id_dossier).attr("style", "color: red")
    }
    else
    window.location.href ="http://localhost:8080/Banque/public/Dossier/"+$id_dossier+"/Realised_in/"+$date;
  }
</script>
@endsection

@section('content')

<div class="row" style="margin-top: 5px;">
       @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block" align="center">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
    <div class=" col-md-2 col-md-push-10">
     <div class="form-group">
      <select class="form-control input-sm" name="Mounth" id="Mounth"  title="mois">
     
                <option selected  value="{{ $Mounth }}">{{$Mounth}}</option>
        
    @for ($i = 1; $i <= 12; $i++)
      @if($mois[$i] != $Mounth)
     <option value="{{$mois[$i]}}">{{$mois[$i]}}</option>
     @endif
    @endfor      
      </select>
    </div>
    </div>
  


  <div class="col-md-10 col-lg-pull-2">
      <div class="panel panel-default">
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >
   Mes Dossiers 
   <div style="float: right;"> Taux : {{ $taux }}% </div>
   <div style="float: left;"> <a style="color: white;" href="{{ url('/Dossiers/new') }}"><button class="btn btn-primary" style="  border-radius: 50%;   width: 40px;  height: 40px;" title="Ajouter un nouveau Dossier"><b>+</b></button></a></div>
    </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Dossier </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Num de tier </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Statut  </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Date d'affectation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Date de realisation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Action </th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($MesDossiers as $t)
    <tr>
      <td>{{$t->name}}</td>
      <td>{{$t->numT}}</td>
      @if($t->etat==0)
      <td> Pas encore  </td>
      @else
      <td> Réalisé </td>
      @endif
      <td>{{$t->affectation}}</td>
      @if(empty($t->realisation))
      <td>       <input type="date" title="ajouter la date de réalisation" name="dateRealisation" id="{!! $t->id_dossier !!}">
      <small class=" {!! $t->id_dossier !!}  help-block" style="display:none;"><i>vous avez oublie la date</i></small>
    </td>
      <td>
      
    <img src="template/img/check.png" title="marque comme Réalisé" onclick="marqued({!! $t->id_dossier !!})" height="25" width="25">
      </td>
      @else
      <td>{{$t->realisation}}</td>
      <td>-</td>
      @endif
    </tr>
     @endforeach
  </tbody>
</table>  
<div style="text-align: center;">
{{ $MesDossiers->links() }}  
</div>


  </div>
</div>
  </div>
</div>



   <script>
  $('#Mounth').on('change',function(e)
  {
  
   var Mounth= e.target.value;
   // var nom_agence="<?php echo Session::get('nom_agence');?>";
  // alert($nom_agence);
   
    var nom=$('#year option:selected').text();
    window.location.href ="http://localhost:8080/Banque/public/MesDossiers/Mounth/"+Mounth;

  });


</script>

@endsection