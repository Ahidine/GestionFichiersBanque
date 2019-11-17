<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::group(['middleware'=>'auth'],(function () {


Route::group(['middleware'=>'Directeur'],(function () {
Route::get('acceuil','AcceuilControlleur@index');
Route::get('MesAgences','AcceuilControlleur@agences');
Route::get('agence/{id}/{nom}','AcceuilControlleur@details');
Route::get('Objectif/{year}','AcceuilControlleur@ObjectifYear');
Route::get('Agence/{nom}/Mounth/{Mounth}','AcceuilControlleur@AgenceMounth');
}));
//Agent
Route::group(['middleware'=>'Agent'],(function () {
Route::get('AcceuilAgent','AgentControlleur@index');
Route::get('MesDossiers','AgentControlleur@MesDossiers');
Route::get('MesDossiers/Mounth/{Mounth}','AgentControlleur@AgentMounth');
Route::get('/Dossiers/new','AgentControlleur@store');
Route::post('Add_Dossier','AgentControlleur@Add_Dossier')->name('dossier.add');
Route::get('Dossier/{id_dossier}/Realised_in/{date}','AgentControlleur@DossierRealise');

}));
//CA
Route::group(['middleware'=>'CA'],(function () {
Route::get('AcceuilCA','ChefAgentControlleur@index');
Route::get('Mon_agence','ChefAgentControlleur@MonAgence');
Route::get('Show_Agents','ChefAgentControlleur@Show_Agents');
Route::get('/agents/new','ChefAgentControlleur@store');
Route::post('Add_Agent','ChefAgentControlleur@Add_Agent')->name('agent.add');
Route::get('bloquer/{id}','ChefAgentControlleur@bloquer');
Route::get('debloquer/{id}','ChefAgentControlleur@debloquer');
Route::get('Les_Dossiers','ChefAgentControlleur@Les_Dossiers');
Route::get('Update_Dossiers/{id_agent}/{id_dossier}','ChefAgentControlleur@Update_Dossiers');
Route::get('delete_dossier/{id_agent}/{id_dossier}','ChefAgentControlleur@Delete_dossier');
Route::get('Setting','ChefAgentControlleur@Setting');
Route::put('update','ChefAgentControlleur@update')->name('agent.update');
}));



}));


Route::get('/',function(){
	if(Auth::check())
{
	if(Auth::user()->profile=="Ag")
	return redirect('/AcceuilAgent');	
	else
		if(Auth::user()->profile=="CA")
			return redirect('/AcceuilCA');




     return redirect('/acceuil');

}
else
{
	return view('auth.login');
}
});
