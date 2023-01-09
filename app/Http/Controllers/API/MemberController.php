<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MemberResource;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::orderBy('surname')->get();

        if($request->has('search')) {
            $members = Member::where('surname', 'LIKE', "%{$request->search}%")->orWhere('first_name', 'LIKE', "%{$request->search}%")->get();
        }

        return MemberResource::collection($members);
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
            'first_name' => ['required', 'string', 'max:15'],
            'surname' => ['required', 'string', 'max:15'],
            'middle_name' => ['max:15'],
            'birthday' => ['max:15'],
            'state' => ['required', 'string', 'max:25'],
            'lga' => ['required', 'string', 'max:25'],
            'address' => ['string', 'min:10', 'max:255'],
            'phone' => ['max:15'],
            'image' => ['mimes:jpg,jpeg']
        ]);

        $image = $request->file('image');

        $name = $request->first_name . '-' . $request->surname . '-'. $request->phone . '.' . $image->extension();

        $move = $image->move(public_path('images'), $name);

        
        $member = Member::create([
            'first_name' => $request->input('first_name'),
            'surname' => $request->input('surname'),
            'middle_name' => $request->input('middle_name'),
            'birthday' => $request->input('birthday'),
            'state' => $request->input('state'),
            'lga' => $request->input('lga'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'img_path' => $name
        ]);
        return response()->json($member);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::where('id', $id)->with('departments', 'cell', 'attendaces')->first();
        return response()->json([
            'member' => $member,
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
            'first_name' => ['required', 'string', 'max:15'],
            'surname' => ['required', 'string', 'max:15'],
            'middle_name' => ['max:15'],
            'birthday' => ['max:15'],
            'state' => ['required', 'string', 'max:25'],
            'lga' => ['required', 'string', 'max:25'],
            'address' => ['string', 'min:10', 'max:255'],
            'phone' => ['max:15'],
        ]);

        
        $member = Member::where('id', $id)->update([
            'first_name' => $request->input('first_name'),
            'surname' => $request->input('surname'),
            'middle_name' => $request->input('middle_name'),
            'birthday' => $request->input('birthday'),
            'state' => $request->input('state'),
            'lga' => $request->input('lga'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);
        return response()->json($member);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

