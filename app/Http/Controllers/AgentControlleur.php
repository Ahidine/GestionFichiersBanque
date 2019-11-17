<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\User;
use App\Agent;
use App\Dossier;
use Validator;

class AgentControlleur extends Controller
{
    //
       public function index()
    {
      $user = Auth::user();
    

        return view('Agent.AcceuilAgent');
    }



     public function MesDossiers()
    {
      $user = Auth::user();
      $id=User::find($user->id)->agents()->first()->id;
      //$region=Region::all();
     // $year=session('year');

      if (empty(session('mois_S')))
       {
        $Mounth=date('m');// mois actuel
       }
      else
      {
         $Mounth=session('mois_S');
      }
      $mois=array();
     // session(['id_agence' => $id]);
     // session(['nom_agence' => $nom]);
      for ($i=1; $i <=12 ; $i++) { 
         $mois[$i]=$i;
      }
      //on recuperer l'objectif
    $objectifs=DB::table('agent_dossiers as ad')
                ->Select(DB::raw('count(*) as nbr'))
                ->join('agents as a','a.id','=','ad.agent_id')
                ->whereMonth('ad.date_affectation','=',$Mounth)
				->whereYear('ad.date_affectation', date('Y'))
                ->where('a.id','=',$id)
                ->first()->nbr;


    //on recupere le nombre de dossiers réalise 
    $Nombres_R=DB::table('agent_dossiers as ad')
                ->Select(DB::raw('count(*) as nbr'))
                ->join('agents as a','a.id','=','ad.agent_id')
                ->whereMonth('ad.date_affectation','=',$Mounth)
				->whereYear('ad.date_affectation', date('Y'))
                ->where([ ['a.id','=',$id],['ad.statut','=',1]])
                ->get();

                
//je teste si la requet renvoie qlq chose pour que je puisse calculer le taux et éviter les execepetions 

                    if ( isset($Nombres_R[0])) {
                      # code...
                      $Nombres_R=$Nombres_R[0]->nbr;
                    }
                    else
                    {
                      $Nombres_R=0;
                    }

    if ($objectifs==0) {
      # code...
      $taux="";

    }
    else
    {
       // on calcule le taux
        $taux= (    (  $Nombres_R / ($objectifs)  )  *100 );
        $taux=number_format($taux,2); 

    }

    
   
   
                   
            
      

    //les détails à afficher dans la view
      
    	$MesDossiers=DB::table('agent_dossiers as ad')
                ->Select('d.Name as name','ad.date_affectation as affectation','ad.date_Realisation as realisation','ad.statut as etat','d.NumTier as numT','d.CIN as cin','d.id as id_dossier')
                ->join('agents as a','a.id','=','ad.agent_id')
                ->join('users as u','u.id','=','a.user_id')
                ->join('dossiers as d','d.id','=','ad.dossier_id')
                ->whereMonth('ad.date_affectation','=',$Mounth)
			         	->whereYear('ad.date_affectation', date('Y'))
                ->where('a.id','=',$id)
                ->paginate(10);
             
     
               
               // return $dossiers[0]->date_Realisation;
     /*  $N_R=DB::table('agence_dossier as ad')
                    ->Select(DB::raw('count(*) as nbr'),'ajd.date_Realisation as created_at')
                    ->join('dossiers as d','d.id','=','ad.dossier_id')
                    ->join('agent_dossiers as ajd','ajd.dossier_id','=','d.id')
                    ->where([
                                ['ad.agence_id','=',$id],
                                ['ad.statut', '=', 1],
                            ])
                    ->groupBy('ajd.date_Realisation')
                    ->get();


            $chart = Charts::database($N_R->nbr,$N_R->created_at, 'bar', 'highcharts')
                  ->title("Product Details")
                  ->elementLabel("Total Products")
                  ->dimensions(500, 500)
                  ->responsive(true);
    */
                  
                 






              //  return $dossiers;
                return view('Agent.MesDossiers',compact('MesDossiers','mois','taux','Mounth'));

    }
    //fonction a pour but de récuperer les details d'une agence spécifique dans un mois spécifique 
    public function AgentMounth($Mounth)
    {
        session(['mois_S' => $Mounth]);
       // $id=session('id_agence');
        return redirect('MesDossiers');
    }


  //view qui contient le formulaire pour créer un nouveau dossiers
    public function store()
    {

         return view('Agent.NewDossiers');
    }
    //view pour créer le nouveau agent et envoyer le password à son propre email
    public function Add_Dossier(Request $request)
    {
        $v = Validator::make($request->all(), [
            'numtier' => 'required|unique:dossiers,numtier|max:25',
            'name' => 'required',
            'cin'=>'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $user = Auth::user();
        $id=User::find($user->id)->agents()->first()->id;
        $id_agence= Agent::find($id)->agence_id;
        $now = date("Y-m-d");


        //changer le max du temps 
        set_time_limit(0);
        //creer un nouveau user
        $nvdossier = new Dossier;
        $nvdossier->name = $request->name;
        $nvdossier->NumTier = $request->numtier;
        $nvdossier->CIN = $request->cin;
        $nvdossier->save();
        //lier le dossier avec l'agent et l'agence
        $dossier=Dossier::where('NumTier', '=',$request->numtier)->first();
        $dossier->agents()->attach($id,['date_affectation' => $now]);
        $dossier->agences()->attach($id_agence,['date_affectation' => $now]);
        $dossier->save();


     return redirect('MesDossiers')->with('success', 'le dossier '.$request->name.' a été créé avec succès');
    }
    public function DossierRealise($id_dossier,$date)
    {
        $user = Auth::user();
        $agent=User::find($user->id)->agents()->first();
        $agent->dossiers()->updateExistingPivot($id_dossier,['date_Realisation'=>$date,'statut'=>1]);

      return back();
    }
}
