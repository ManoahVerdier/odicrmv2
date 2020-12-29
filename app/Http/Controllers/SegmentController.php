<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Segment::all()->toJson();
    }

    /**
     * Display a listing of the resource of the selected type.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexType($type)
    {
        $selected='';
        if(session($type.'_segment_selected') ?? false) {
            $selected = session($type.'_segment_selected');
        }
        return json_encode(['selected' => $selected,
            'list' =>Segment::where('type', $type)->get()->toArray()
        ]);
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
        $segment = Segment::create($request->all());
        session([$segment->type.'_segment_selected' => $segment->id]);
        return json_encode(array("statusCode"=>200,"id"=>$segment->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function show(Segment $segment)
    {
        session([$segment->type.'_segment_selected' => $segment->id]);
        return json_encode($segment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function edit(Segment $segment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segment $segment)
    {
        $segment->update($request->all());
        return json_encode(array("statusCode"=>200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment)
    {
        session()->forget($segment->type.'_segment_selected');
        $segment->delete();
        return json_encode(array("statusCode"=>200));
    }

    /**
     * Remove segment from session
     *
     * @param \App\Models\Segment $segment le segment selectionné
     * 
     * @return void
     */
    public function forget(Segment $segment)
    {
        session()->forget($segment->type.'_segment_selected');
        return json_encode(array("statusCode"=>200));
    }
}
