@extends('CA.racine_CA')
@section('head-section')
<script type="text/javascript">
  function update_dossier($id_dossier,$my_id)
  {
   // $value=$('#'+$my_id+'option:selected').val();
    $id_agent =document.getElementById($my_id).value;
    window.location.href ="http://localhost:8080/Banque/public/Update_Dossiers/"+$id_agent+"/"+$id_dossier;
  }
  function delete_dossier($id_dossier,$id_agent)
  {
    //alert($id_dossier+' '+$id_agent);
    window.location.href ="http://localhost:8080/Banque/public/delete_dossier/"+$id_agent+"/"+$id_dossier; 
  }

</script>
@endsection

@section('content')
<?php $my_id=1; ?>

<div class="row">
  <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-default" style=" margin-top: 15px;" >
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >Gestions des dossiers </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Dossier </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Responsable</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Modifier</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($dossiers as $t)
    <tr>
      <td>{{$t->DosName}}</td>
      @if($t->responsable=='')
      <td>
        
               <div class="form-group">
                <?php $my_id++; ?>
              

      <select class="form-control input-sm col-md-4" id="{!! $my_id !!}" name="responsable"  onchange="update_dossier({!! $t->id_dossier !!},{!! $my_id !!})" >

              <option selected disabled> Ajouter un responsable ! </option>
    

          @foreach($respo as $r)
          
           <option value="{!! $r->id !!}">{!! $r->name !!}</option>
          @endforeach
      </select>
    </div>
      </td>
      @else
      <td>{{$t->responsable}}</td>
      @endif
      <td><button class="btn btn-primary" onclick="delete_dossier({!! $t->id_dossier !!},{!! $t->id_agent !!})">-</button></td>
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
@endsection