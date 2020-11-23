<?php

namespace App\Http\Controllers;

use App\Models\FieldValue;
use App\Models\ClientField;
use Illuminate\Http\Request;

class FieldValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $targets  = FieldValue
            ::select(
                'field_name', 
                'target_name', 
                'target_class'
            )
            ->distinct()
            ->get()
            ->groupBy('target_name');
        return view('pages.settings.fieldvalues', compact('targets'));
    }

    public function values(Request $request)
    {
        $values = FieldValue
            ::where('target_name', $request['target'])
            ->where('field_name', $request['field'])
            ->orderBy('order', 'asc')
            ->orderBy('label', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return json_encode($values);
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
        $fieldValue = FieldValue::create($request->all());
        return json_encode(array("statusCode"=>200,"id"=>$fieldValue->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function show(FieldValue $fieldvalue)
    {
        //$fieldValue=FieldValue::find($fieldValue);
        dd($fieldvalue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function edit(FieldValue $fieldvalue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FieldValue $fieldvalue)
    {
        $fieldvalue->update($request->all());
        dd($fieldvalue);
        return json_encode(array("statusCode"=>200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(FieldValue $fieldvalue)
    {
        $fieldvalue->delete();
        return json_encode(array("statusCode"=>200));
    }
}