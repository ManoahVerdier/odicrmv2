<?php 

return [
    'name'=>'Commerciaux',
    'attributes'=>[
        "id"                    =>  "Id"                    ,
        "name"                  =>  "Nom"                   ,
        "active"                =>  "Actif"                 ,
        "code_societe"          =>  "Société"               ,
        "agents"=>[
            "id"                    =>  "Id"                    ,
            "name"                  =>  "Nom"                   ,
            "active"                =>  "Actif"                 
        ],
        "branches"=>[
            "id"                    =>  "Id"                    ,
            "name"                  =>  "Société"               ,
            "code"                  =>  "Code"                 
        ]
    ]
];