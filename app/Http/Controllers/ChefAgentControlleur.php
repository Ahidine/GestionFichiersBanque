<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\User;
use App\Agence;
use App\Agent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DateTime;
class ChefAgentControlleur extends Controller
{
    //
 

//view de bienvenue
    public function index()
    {
      $user = Auth::user();

        return view('CA.AcceuilCA');
    }

    //view pour afficher tous les agents
    public function Show_Agents()
    {
        $user = Auth::user();
        $id_agence= User::find($user->id)->agences()->get(array('id'))[0]->id;
        $agents=DB::table('agents as a')
                ->Select('u.name','u.last_name','u.created_at','u.email','u.is_blocked','u.id')
                ->join('agences as ag','ag.id','=','a.agence_id')
                ->join('users as u','u.id','=','a.user_id')
                ->where('ag.id','=',$id_agence)
                ->paginate(10);
        return view('CA.agents',compact('agents'));
    }

    //view qui contient le formulaire pour créer un nouveau agent
    public function store()
    {
        return view('CA.New_Agent');
    }

    //view pour créer le nouveau agent et envoyer le password à son propre email
    public function Add_Agent(Request $request)
    {
        $user = Auth::user();
        $id_agence= User::find($user->id)->agences()->get(array('id'))[0]->id;

        //changer le max du temps 
        set_time_limit(0);
        //generer un password
        $pass=str_random(8);
        //recuperer les données 
        $data = array(
            'name'      =>  $request->name,
            'last_name'   =>  $request->last_name,
            'email' =>$request->email,
            'pass' =>$pass
        );
        //creer un nouveau user
        $nvuser = new User;
        $nvuser->name = $request->name;
        $nvuser->last_name=$request->last_name;
        $nvuser->email = $request->email;
        $nvuser->profile='Ag';
        $nvuser->password=bcrypt($pass);
        $nvuser->save();
        //lier le user avec l'agent
        $agent=new Agent;
        $agent->user_id=User::where('email', '=',$request->email)->first()->id;;
        $agent->agence_id=$id_agence;
        $agent->save();
        
        //envoyer un email qui contient le username && password generer
        Mail::to($request->email)->send(new SendMail($data));

     return redirect('Show_Agents')->with('success', 'l agent '.$request->name.' '.$request->last_name.' a été créé avec succès');
    }


    //viw pour afficher toutes informations qui concerne l'agence
    public function MonAgence()
    {
        $user = Auth::user();
        $id= User::find($user->id)->agences()->get(array('id'))[0]->id;
    	$nom= User::find($user->id)->agences[0]->Name;

  
      $dossiers=DB::table('agences as a')
                ->Select('d.Name as DosName','agd.statut as etat',DB::raw('CONCAT(u.name," ",u.last_name) as responsable'),'agd.date_affectation as affectation','agd.date_Realisation as Realisation' )
                ->join('agence_dossier as ad','a.id' ,'=' ,'ad.agence_id')  
                ->join('dossiers as d','d.id', '=' ,'ad.dossier_id') 
                ->join('agent_dossiers as agd','agd.dossier_id','=' ,'d.id') 
                ->join('agents as ag','ag.id', '=','agd.agent_id') 
                ->join('users as u','u.id','=','ag.user_id')
                ->where('a.id','=',$id) 
                ->paginate(10);
              // return $dossiers;
                return view('CA.MonAgence',compact('dossiers','nom'));
    	

    }
    public function bloquer($id)
    {
        $agent = User::find($id);
        $agent->is_blocked = 1;
        $agent->save();
        return redirect('Show_Agents')->with('success', 'l agent '.$agent->name.' '.$agent->last_name.' a été  bloquer');
    }

        public function debloquer($id)
    {
        $agent = User::find($id);
        $agent->is_blocked = 0;
        $agent->save();
        return redirect('Show_Agents')->with('success', 'l agent '.$agent->name.' '.$agent->last_name.' a été  bloquer');
    }

    public function Les_Dossiers()
    {   
                $user = Auth::user();
                $id= User::find($user->id)->agences()->get(array('id'))[0]->id;
                $dossiers=DB::table('agences as a')
                ->Select('d.Name as DosName','ad.statut as etat',DB::raw('CONCAT(u.name," ",u.last_name) as responsable'),'a.id as id_agence','d.id as id_dossier','ag.id as id_agent')
                ->join('agence_dossier as ad','a.id' ,'=' ,'ad.agence_id')  
                ->join('dossiers as d','d.id', '=' ,'ad.dossier_id') 
                ->leftJoin('agent_dossiers','agent_dossiers.dossier_id','=' ,'d.id') 
                ->leftJoin('agents as ag','ag.id', '=','agent_dossiers.agent_id') 
                ->leftJoin('users as u','u.id','=','ag.user_id')
                ->where('a.id','=',$id) 
                ->paginate(10);

                $respo=DB::table('agents as a')
                ->Select('u.name','u.last_name','u.created_at','u.email','u.is_blocked','a.id')
                ->join('agences as ag','ag.id','=','a.agence_id')
                ->join('users as u','u.id','=','a.user_id')
                ->where('ag.id','=',$id)
                ->get();
                




                return view('CA.Dossiers',compact('dossiers','respo'));
    }
    public function Update_Dossiers($id_agent,$id_dossier)
    {
            $agent=Agent::find($id_agent);
            $now = date("Y-m-d");
            $agent->dossiers()->attach($id_dossier,['date_affectation' => $now]);
            return back();    
    }
    public function Delete_dossier($id_agent,$id_dossier)
    {
            $agent=Agent::find($id_agent);
            $now = date("Y-m-d");
            //return $id_agent.$id_dossier;
            $agent->dossiers()->detach($id_dossier);

            return back();   
    }
    public function Setting()
    {
        $user=Auth::user();
        return view('CA.Setting',compact('user'));
    }
    public function update(Request $request)
    {
        $mdpuser=$request['Apassword'];
        $user=Auth::user();
        $verifypass = password_verify($mdpuser, $user->password);
 
       if ($verifypass == true)
       {
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->profile = 'CA';
        $user->is_blocked = 0;
        $user->password_is_changed = 1;
        $user->email = $request['email'];
        $user->password=bcrypt($request['password']);
        

        $user->save();
         
         return redirect('Setting')->withOk("modification a été fait avec succes ");
 
       }
       else{
 
           return redirect('Setting')->with('notok','mdp incorrect ');
       }
    }
}
