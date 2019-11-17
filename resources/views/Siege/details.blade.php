@extends('Siege.racine')
@section('head-section')

@endsection

@section('content')

<div class="row" style="margin-top: 5px;">
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
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" ><a style="float: left;" href="{{url('Objectif/'. session('year') ) }}"> <button class="btn btn-primary"><i class="fa fa-arrow-left"></i> back</button> </a> Agence : {{$nom}} <div style="float: right;"> Taux : {{ $taux }}% </div> </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Dossier </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Statut  </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">date d'affectation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">date de realisation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Responsable</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($dossiers as $t)
    <tr>
      <td>{{$t->DosName}}</td>
      @if($t->etat==0)
      <td> Pas encore </td>
      <td>{{$t->affectation}}</td>
      <td>X</td>
      @else
      <td> Réalisé </td>
      <td>{{$t->affectation}}</td>
      <td>{{$t->date_Realisation}}</td>
      @endif
      <td>{{$t->full_name}}</td>
    </tr>
     @endforeach
  </tbody>
</table>  
<div style="text-align: center;">
{{ $dossiers->links() }}  
</div>


  </div>
</div>
  </div>
</div>



   <script>
  $('#Mounth').on('change',function(e)
  {
  
   var Mounth= e.target.value;
    var nom_agence="<?php echo Session::get('nom_agence');?>";
  // alert($nom_agence);
   
    var nom=$('#year option:selected').text();
    window.location.href ="http://localhost:8080/Banque/public/Agence/"+nom_agence+"/Mounth/"+Mounth;

  });


</script>

@endsection