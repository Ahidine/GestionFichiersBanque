<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Region;
use DB;
use Session;
use App\Product;
use App\User;
use Charts;

class AcceuilControlleur extends Controller
{
    //
  //la view de la  Bienvenue 
   public function index()
    {
      $id_user = Auth::user()->id;
      $region=User::find($id_user)->regions()->first();
 
     
        
       
        session(['SRegion' => $region]);

        return view('Siege.Acceuil',compact('region'));
    }
    //la view qui contient de toutes les informations de régions (les agences , chef , objctif ...)
    //$id : c'est le id de la région récupérer via la view racine 
    //nom : c'est le nom de la région 
    public function agences()
    {
    	  $user = Auth::user();
        //on met le nom de la région et l'Id dans session afin de mémoriser la région durant toute l'app
        $region=session('SRegion');
        
   
    	//	$region=Region::all();
            $year=date('Y');
            session(['year' => $year]);

        //jointure entre les tables dédie afin d'afficher les informations nécessaires 
    	  $agences=DB::table('agences')
                    ->Select('agences.id','agences.Name as Ag','u.Name as Us','u.last_name','agences.Effectif','o.Nombres',DB::raw('SUM(agd.statut) as Realise'))
                    ->join('users as u','u.id','=','agences.user_id')
                    ->join('age_obj as ao','ao.agence_id','=','agences.id')
                    ->join('objectifs as o','o.id','=','ao.objectif_id')
                    ->leftJoin('agence_dossier as ad','agences.id','=','ad.agence_id')
                    ->leftJoin('dossiers as d','d.id','=','ad.dossier_id')
                    ->leftJoin('agent_dossiers as agd','agd.dossier_id','=' ,'d.id')
                    ->where([
                                ['agences.region_id','=',$region->id],
                                ['o.date_obj', '=', $year],
                            ])
                    ->groupBy('agences.id','agences.Name','u.Name','u.last_name','agences.Effectif','o.Nombres')
                    ->paginate(10);

            // return $agences;
            // agences: view 
            // agences :variables qui contient toutes les données 
            // région  :toutes les régions pour remplire le select 
            // nom     :nom c 'est  le nom de la région déja cliqué 
                    
                 
          return view('Siege.agences',compact('agences','region','year'));



    }
    //fonction de select year a pour but de voir l'objectif des agences selon l'année 
    public function ObjectifYear($year)
    {
                  $region=session('SRegion');
                  session(['year' => $year]);
                  $agences=DB::table('agences')
                    ->Select('agences.id','agences.Name as Ag','u.Name as Us','u.last_name','agences.Effectif','o.Nombres',DB::raw('SUM(agd.statut) as Realise'))
                    ->join('users as u','u.id','=','agences.user_id')
                    ->join('age_obj as ao','ao.agence_id','=','agences.id')
                    ->join('objectifs as o','o.id','=','ao.objectif_id')
                    ->leftJoin('agence_dossier as ad','agences.id','=','ad.agence_id')
                    ->leftJoin('dossiers as d','d.id','=','ad.dossier_id')
                    ->leftJoin('agent_dossiers as agd','agd.dossier_id','=' ,'d.id')
                    ->where([
                                ['agences.region_id','=',$region->id],
                                ['o.date_obj', '=', $year],
                            ])
                    ->groupBy('agences.id','agences.Name','u.Name','u.last_name','agences.Effectif','o.Nombres')
                    ->paginate(10);

        return view('Siege.agences',compact('agences','region','year'));
    }
    //details d'une agence spécifique 
    public function details($id,$nom)
    {
      $region=session('SRegion');
      $year=session('year');

      if (empty(session('mois_S')))
       {
        $Mounth=date('m');// mois actuel
      }
      else
      {
         $Mounth=session('mois_S');
      }
      $mois=array();
      session(['id_agence' => $id]);
      session(['nom_agence' => $nom]);
      for ($i=1; $i <=12 ; $i++) { 
         $mois[$i]=$i;
      }
      //on recuperer l'objectif
     $objectifs=DB::table('age_obj as ao')
                ->Select('o.Nombres')
                ->join('objectifs as o','o.id','=','ao.objectif_id')
                ->where('ao.agence_id','=',$id)
                ->first()->Nombres;

    //on recupere le nombre de dossiers réalise 
     $Nombres_R=DB::table('agence_dossier as ad')
                    ->Select(DB::raw('count(*) as nbr'))
                    ->join('dossiers as d','d.id','=','ad.dossier_id')
                    ->join('agent_dossiers as ajd','ajd.dossier_id','=','d.id')
                    ->where([
                                ['ad.agence_id','=',$id],
                                ['ajd.statut', '=', 1],
                            ])
                    ->whereMonth('ajd.date_affectation','=',$Mounth)
                    ->whereYear('ajd.date_affectation', $year)
                    ->groupBy('ad.agence_id')
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

    
    // on calcule le taux
  if ($objectifs==0) {
      # code...
      $taux="";

    }
    else
    {
      $objectifs_menseul= ($objectifs/12);

      $taux= (    (  $Nombres_R / $objectifs_menseul )  *100 );
    
    }
    
            
      

    //les détails à afficher dans la view
      $dossiers=DB::table('agences as a')
                ->Select('d.Name as DosName','ajd.statut as etat',DB::raw('CONCAT(u.name," ",u.last_name) as full_name'),'ajd.date_Realisation','ajd.date_affectation as affectation')
                ->join('agence_dossier as ad','a.id' ,'=' ,'ad.agence_id')  
                ->join('dossiers as d','d.id', '=' ,'ad.dossier_id') 
                ->join('agent_dossiers as ajd','ajd.dossier_id','=' ,'d.id') 
                ->join('agents as ag','ag.id', '=','ajd.agent_id') 
                ->join('users as u','u.id','=','ag.user_id')
                ->where('a.id','=',$id)
                ->whereMonth('ajd.date_affectation','=',$Mounth)
                ->whereYear('ajd.date_affectation', '2019')
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
                return view('Siege.details',compact('dossiers','nom','region','mois','taux','chart','Mounth'));

    }
    //fonction a pour but de récuperer les details d'une agence spécifique dans un mois spécifique 
    public function AgenceMounth($nom,$Mounth)
    {
        session(['mois_S' => $Mounth]);
        $id=session('id_agence');
        return redirect('agence/'.$id.'/'.$nom);
    }
    public function charts()
    {
       /* $products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

        $chart = Charts::database($products, 'bar', 'highcharts')
                  ->title("Product Details")
                  ->elementLabel("Total Products")
                  ->dimensions(1000, 500)
                  ->responsive(true);*/
                
    }
}
