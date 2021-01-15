<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnsNames = Branch::columns();
        return view('pages.branches.index', compact('columnsNames'));
    }

    /**
     * Retourne les données pour l'appel ajax de l'index
     *
     * @param Request $request la requête AJAX
     * 
     * @return json
     */
    public function branchesDataSourceAjax(Request $request)
    {
        //Récupération des paramètres de la liste
        $draw   = $request->post('draw', 0);
        $order  = $request->post('order', array(array('column'=>1,'dir'=>'asc'))); 

        // Récupération de la liste des colonnes
        $columns = Branch::columns();
        
        //Initialisation de la requête
        $query = Branch::query();
        foreach ($columns as $col) {
            $query->addSelect($col);
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
        $branches = $query->get();
        foreach ($branches as $branch) {
            $json['data'][] = array_values($branch->toArray());
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
        $branch = new Branch;
        return view('pages.branches.create', compact('branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = Branch::create($request->all());
        return redirect('branches/'.$branch->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }

    public function list(Request $request)
    {
        return Branch::all()->toJson();
    }
}
