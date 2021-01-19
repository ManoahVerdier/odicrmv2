<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientContract;
use App\Models\ClientCommercial;
use App\Models\Field;
use App\Models\FieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ClientStoreRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnsNames = Client::columnsWithExtended();
        return view('pages.clients.index', compact('columnsNames'));
    }

    /**
     * Retourne les données pour l'appel ajax de l'index
     *
     * @param Request $request la requête AJAX
     * 
     * @return json
     */
    public function clientsDataSource(Request $request)
    {
        //Récupération des paramètres de la liste
        $search = $request->post('search', array('value' => '', 'regex' => false));
        $draw   = $request->post('draw', 0);
        $start  = $request->post('start', 0);
        $length = $request->post('length', 25);
        $order  = $request->post('order', array(array('column'=>1,'dir'=>'asc'))); 

        dd($request);

        // Récupération de la liste des colonnes
        $columns = Client::columnsWithExtended();
        

        //Initialisation de la requête
        $query = Client::leftJoin('clients_commercials', 'clients.id', '=', 'clients_commercials.client_id');
        $query->leftJoin('clients_contracts', 'clients.id', '=', 'clients_contracts.client_id');
        foreach ($columns as $col) {
            $query->addSelect($col);
        }
        

        //Gestion des filtres par colonne
        $filter = array();
        foreach ($request->columns as $column) {
            
            if ($column['search']['value'] ?? false) {
                $filter[$column['name']] = $column['search']['value'];
            }
        }
        if (!empty($filter)) {
            foreach ($filter as $column => $value) {
                $query->where($column, 'like', '%'.$value.'%');
            }
            
        }
        
        //Gestion de la recherche générale
        if (!empty($search['value'])) {
            $query->where('clients.name', 'like', '%'.$search['value'].'%');
        }
        
        //Nombre total de résultats
        $recordsTotal = $query->count();

        //Tri et taille des résultats
        $sortColumnName = $columns[$order[0]['column']];
        $query->orderBy($sortColumnName, $order[0]['dir'])
            ->take($length)
            ->skip($start);

        //Préparation du json contenant les résultats
        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
            "searchPanes"=>[
                "options"=>[
                    "name"=>[
                        [
                           "label"=>"Aaron",
                           "total"=>"1",
                           "value"=>"Aaron",
                           "count"=>"1"
                        ],
                        [
                           "label"=>"Alex",
                           "total"=>"1",
                           "value"=>"Alex",
                           "count"=>0
                        ],
                        [
                           "label"=>"Alexa",
                           "total"=>"1",
                           "value"=>"Alexa",
                           "count"=>0
                        ]
                    ]
                ]
            ]
        );

        //Execution de la requête et remplissage du json
        $clients = $query->get();
        foreach ($clients as $client) {
            $json['data'][] = array_values($client->toArray());
        }

        return $json;
    }
    /**
     * Retourne les données pour l'appel ajax de l'index
     *
     * @param Request $request la requête AJAX
     * 
     * @return json
     */
    public function clientsDataSourceAjax(Request $request)
    {
        //Récupération des paramètres de la liste
        $draw   = $request->post('draw', 0);
        $order  = $request->post('order', array(array('column'=>1,'dir'=>'asc'))); 

        //dd($request);

        // Récupération de la liste des colonnes
        $columns = Client::columnsWithExtended();
        
        //Initialisation de la requête
        $query = Client::leftJoin('clients_commercials', 'clients.id', '=', 'clients_commercials.client_id');
        $query->leftJoin('clients_contracts', 'clients.id', '=', 'clients_contracts.client_id');
        $query->leftJoin('agents', 'clients_commercials.agent_id', '=', 'agents.id');
        $query->leftJoin('branches', 'clients.branch_id', '=', 'branches.id');
        foreach ($columns as $col) {
            if (Str::contains($col, 'clients')) {
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
        $clients = $query->get();


        foreach ($clients as $client) {
            $json['data'][] = array_values($client->toArray());
        }

        return $json;
    }

    /**
     * Réalise la modification en masse des enregistrements
     *
     * @param Request $request la requête ajax réalisée (POST)
     * 
     * @return json
     */
    public function massEdit(Request $request)
    {
        $matched = json_decode($request->post('json'));
        $field = $request->post('field');
        $value = $request->post('value');
        $ids = [];
        foreach ($matched as $row) {
            $ids[] = $row[0];
        }
        
        if (in_array($field, Client::columns())) {
            Client::whereIn('id', $ids)->update(["$field"=>$value]);
        }
        if (in_array($field, ClientContract::columns())) {
            ClientContract::whereIn('client_id', $ids)->update(["$field"=>$value]);
        }
        if (in_array($field, ClientCommercial::columns())) {
            ClientCommercial::whereIn('client_id', $ids)->update(["$field"=>$value]);
        }
        
    }

    /**
     * Charge les infos pour le champs de modification d'un champ
     *
     * @param Request $request la requête ajax réalisée (POST)
     * 
     * @return json
     */
    public function loadInput(Request $request)
    {
        $field = $request->post('column');
        $client_structure = Field::where('target', 'clients')->where('name', $field)->first();
        if ($client_structure->is_select) {
            if ($client_structure->is_boolean) {
                return [
                    "name"=>$field,
                    "element"=>"select",
                    "values"=>[
                        "0"=>"Non",
                        "1"=>"Oui"
                    ]
                ];
            } else {
                $values = Field::where('name', $field)
                    ->where('target', 'clients')
                    ->first()
                    ->values()
                    ->toArray();
                return [
                    "name"=>$field,
                    "element"=>"select",
                    "values"=>$values
                ];
            }
        } else {
            return [
                "name"=>$field,
                "element"=>"input",
                "type"=>$client_structure->type,
                "pattern"=>$client_structure->pattern
            ];  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::where('target', 'clients')->where('is_required', true)->get();
        return view('pages.clients.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request la requête recue
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->all());
        $client->commercial()->create();
        $client->contract()->create();
        return redirect('clients/'.$client->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client le client affiché
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('pages.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client le client a éditer
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request la requête HTTP recue
     * @param \App\Models\Client       $clients le client mis à jour
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client le client supprimé
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function exists(Request $request)
    {
        $clients = Client::where('name', $request->value)->get();
        return json_encode($clients->count()>0);
    }
}
