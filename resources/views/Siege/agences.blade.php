@extends('Siege.racine')
@section('head-section')

@endsection

@section('content')
<div class="row" style="margin-top: 5px;">
    <div class=" col-md-2 col-md-push-10">
     <div class="form-group">
      <select class="form-control input-sm" name="year" id="year">
           @if(Session::has('year'))
                <option value="<?php echo Session::get('year');?>"><?php echo  Session::get('year');?></option>
           @endif

           @if($year != 2017)
           <option value="2017">2017</option>
           @endif
           @if($year != 2018)
           <option value="2018">2018</option>
           @endif
           @if($year != 2019)
           <option value="2019">2019</option>
           @endif
      
      </select>
    </div>
    </div>
  


  <div class="col-md-10 col-lg-pull-2">
      <div class="panel panel-default">
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >Region : {{$region->Name}} </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Agence </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Chef  </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Effective </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Objectif</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Nombre réalisé</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Nombre resté </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Détail</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($agences as $t)
    <tr>
      <td>{{$t->Ag}}</td>
      <td> {{$t->Us}} {{$t->last_name}} </td>
      <td> {{$t->Effectif}} </td>
      <td>{{$t->Nombres}}</td>
      @if($t->Realise=='')
      <td><small> <i>aucun dossier n'est affecté </i></small></td>
      @else
      <td>{{$t->Realise}}</td>
      @endif

      <td>{{$t->Nombres-$t->Realise}}</td>
      <?php $id_ag=$t->id  ?>
      <?php $nom=$t->Ag ?>
      <td><a href="{{ url('agence/' . $t->id . '/'.$t->Ag) }}"> <button class="btn btn-primary">+</button> </a></td>
    </tr>
     @endforeach
  </tbody>
</table>  
<div style="text-align: center;">
{{ $agences->links() }}  
</div>


  </div>
</div>
  </div>


</div>
   <script>
  $('#year').on('change',function(e)
  {
  
   var year= e.target.value;
   // alert(region_id);
    var nom=$('#year option:selected').text();
    window.location.href ="http://localhost:8080/Banque/public/Objectif/"+year;

  });


</script>
@endsection