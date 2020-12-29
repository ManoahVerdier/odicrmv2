<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnsNames = Deal::columnsWithExtended();
        return view('pages.deals.index', compact('columnsNames'));
    }

    /**
     * Retourne les données pour l'appel ajax de l'index
     *
     * @param Request $request la requête AJAX
     * 
     * @return json
     */
    public function dataSourceAjax(Request $request)
    {
        //Récupération des paramètres de la liste
        $draw   = $request->post('draw', 0);
        $order  = $request->post('order', array(array('column'=>1,'dir'=>'asc'))); 

        //dd($request);

        // Récupération de la liste des colonnes
        $columns = Deal::columnsWithExtended();
        //Initialisation de la requête
        $query = Deal::query();
        $query->leftJoin('agents', 'deals.agent_id', '=', 'agents.id');
        $query->leftJoin('branches', 'deals.branch_id', '=', 'branches.id');
        foreach ($columns as $col) {
            if (Str::contains($col, 'deals')) {
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
        $deals = $query->get();


        foreach ($deals as $deal) {
            $json['data'][] = array_values($deal->toArray());
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        //dd($deal->step);
        $client = $deal->mainTarget;

        return view('pages.clients.show', compact('client', 'deal'));
    }

    /**
     * Get the specified resource.
     *
     * @param  \App\Models\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function ajaxGet(Deal $deal)
    {
        return Deal::with('step')->with('branch')->findOrFail($deal->id)->toJson();
        //return $deal->step->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        //
    }
}
