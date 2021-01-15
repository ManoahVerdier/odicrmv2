<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnsNames = Agent::columnsList();
        return view('pages.agents.index', compact('columnsNames'));
    }

    /**
     * Retourne les données pour l'appel ajax de l'index
     *
     * @param Request $request la requête AJAX
     * 
     * @return json
     */
    public function agentsDataSourceAjax(Request $request)
    {
        //Récupération des paramètres de la liste
        $draw   = $request->post('draw', 0);
        $order  = $request->post('order', array(array('column'=>1,'dir'=>'asc'))); 

        // Récupération de la liste des colonnes
        $columns = Agent::columnsList();
        
        //Initialisation de la requête
        $query = Agent::join('branches', 'branch_id', 'branches.id');
        foreach ($columns as $col) {
            if (Str::contains($col, 'agents')) {
                $query->addSelect($col);
            } else {
                $query->addSelect("$col as ".str_replace('.', '_', $col));
            }
                
        }

        
        
        //Nombre total de résultats
        $recordsTotal = $query->count();

        //Tri et taille des résultats
        $sortColumnName = $columns[$order[0]['column']];
        $query->orderBy($sortColumnName, $order[0]['dir']);

        //Préparation du json contenant les résultats
        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => []
        );

        //Execution de la requête et remplissage du json
        $agents = $query->get();
        foreach ($agents as $agent) {
            $json['data'][] = array_values($agent->toArray());
        }

        return $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agent = new Agent;
        return view('pages.agents.create', compact('agent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent = Agent::create(array_merge($request->all(), ['active' => 1]));
        return redirect('agents/'.$agent->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }

    public function list(Request $request)
    {
        return Agent::where("$request->valName", "$request->val")->get()->toJson();
    }
}
