<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Models\Events;
use App\Models\Attendace;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::orderBy('created_at', 'DESC')->get();

        return EventResource::collection($events);
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
        $request->validate([
            'event' => ['required', 'string', 'max:175'],
            'date' => ['required', 'string', 'max:15']
        ]);

        $att = Attendace::create([]);

        $att = Attendace::select('id')->orderBy('created_at', 'DESC')->first();

        $attendance = $att->id;

        $event = Events::create([
            'topic' => $request->input('event'),
            'date' => $request->input('date'),
            'attendace_id' => $attendance
        ]);
        return response()->json($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Events::where('id', $id)->with('attendace')->first();

        return response()->json([
            'event' => $event,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'topic' => ['required', 'string', 'max:350'],
            'date' => ['required', 'string', 'max:15']
        ]);

        $event = Events::where('id', $id)->update([
            'topic' => $request->input('topic'),
            'date' => $request->input('date')
        ]);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Events::where('id', $id);

        $event->delete();

        return response()->json('Event Deleted Successfully');
    }
}
