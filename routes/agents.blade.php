@extends('CA.racine_CA')
@section('head-section')

@endsection

@section('content')

<div class="row">
  <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-default" style=" margin-top: 15px;" >
  <div class="panel-heading" style="text-align: center; background-color: #4ECDC4; color: white; font-size: 25px;" >Les agents  </div>
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
      <td></td>
      <td>update</td>
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