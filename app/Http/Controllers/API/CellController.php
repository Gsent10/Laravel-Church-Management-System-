<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CellResource;
use App\Models\Cell;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells = Cell::with('members')->orderBy('created_at')->get();

        return response()->json([
            'cells' => $cells,
        ], 200);

        //return CellResource::collection($cells);
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
            'cell' => ['required', 'string', 'max:75'],
        ]);

        $cell = Cell::create([
            'cell' => $request->input('cell'),
        ]);
        return response()->json($cell);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cell = Cell::where('id', $id)->with('members')->first();

        return response()->json([
            'cell' => $cell,
        ], 200);

        //return new CellResource($cell);
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
            'cell' => ['required', 'string', 'max:15']
        ]);

        $cell = Cell::where('id', $id)->update([
            'cell' => $request->input('cell'),
        ]);

        return response()->json($cell);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cell = Cell::where('id', $id);

        $cell->delete();

        return response()->json('Cell Deleted Successfully');
    }
}

