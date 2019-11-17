@extends('CA.racine_CA')
@section('head-section')
<script type="text/javascript">
  function confirmation($id){
    if ($id==1) {
      return confirm("Êtes-vous sûr de bloquer cet agent ?...");
    }
    else
      return confirm("Êtes-vous sûr de débloquer cet agent ?...");
    
}

</script>

@endsection

@section('content')

<div class="row">
     @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
  <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-default" style=" margin-top: 15px;" >
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >Les agents 
  
            <div style="float: right;"> <a style="color: white;" href="{{ url('/agents/new') }}"><button class="btn btn-primary" style="  border-radius: 50%;   width: 40px;  height: 40px;" title="Ajouter un nouveau agent">+</button></a></div>
    
  </div>
  <div class="panel-body">
  <table class="table  table-bordered ">
  <thead >
    <tr >
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Nom </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Prenom  </th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Email</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Date création</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Active</th>
      <th style=" text-align: center; background-color: #78A419 ;  color:  white;" scope="col">Action</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
      @foreach($agents as $t)
    <tr>
      <td>{{$t->name}}</td>
      <td>{{$t->last_name}}</td>
      <td>{{$t->email}}</td>
      <td>{{$t->created_at }}</td>
      @if($t->is_blocked==1)
      <td>No</td>
      <td>
        <a style="color: white;" href="{{ url('/debloquer/' . $t->id) }}"><button  onclick="confirmation(0)" class="btn btn-success" style="  border-radius: 50%;   width: 40px;  height: 40px;" 
        title="Débloquer">-</button> </a>
      </td>
       @else
      <td>Yes</td>
      <td>
        <a style="color: white;"  href="{{ url('/bloquer/' . $t->id) }}"><button  onclick="confirmation(1)" class="btn btn-danger" style="  border-radius: 50%;   width: 40px;  height: 40px;" 
        title="bloquer">x</button> </a>
      </td>
      @endif
    </tr>
     @endforeach
  </tbody>
</table>  
<div style="text-align: center;">
{{ $agents->links() }}  
</div>


  </div>
</div>
  </div>
@endsection