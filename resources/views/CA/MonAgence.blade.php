@extends('CA.racine_CA')
@section('head-section')

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
     
                <option selected  value="">04</option>
        
    @for ($i = 1; $i <= 12; $i++)
      @if($mois[$i] != $Mounth)
     <option value="{{$mois[$i]}}">{{$mois[$i]}}</option>
     @endif
    @endfor      
      </select>
    </div>
    </div>
    <div class="col-md-10 col-lg-pull-2">
      <div class="panel panel-default" style=" margin-top: 15px;" >
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >Agence : {{$nom}} </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Dossier </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Statut  </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">date d'affectation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">date Réalisation </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Responsable</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($dossiers as $t)
    <tr>
      <td>{{$t->DosName}}</td>
      @if($t->etat==0)
      <td> Pas encore </td>
      @else
      <td> Réalisé </td>
      @endif
      <td>{{$t->affectation}}</td>
      <td>{{$t->Realisation}}</td>
      <td>{{$t->responsable}}</td>
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
@endsection