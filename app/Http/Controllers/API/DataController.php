<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Models\Attendace;


class DataController extends Controller
{
    /**
     * 
     *Add a selected member into a cell.
     * 
     */
    public function inputCell(Request $request, $id)
    {
        $request->validate([
            'cell_id' => ['required', 'int']
        ]);

        $hasCell = Member::where('id', $id)->whereNotNull('cell_id')->exists();

        if ($hasCell) {
            return response()->json('Already has a Cell');
        } else {
            $addCellMembers = Member::where('id', $id)->update([
                'cell_id' => $request->input('cell_id'),
            ]);
            return response()->json('Added Successfully');
        }

        
    }

    /**
     * 
     *Add a selected member into a department.
     * 
     */
    public function inputDepartment(Request $request, $id)
    {

        $department_id = $request->input('department_id');

        $member = Member::find($id);

        $department_row = $member->departments()->where('department_id', $department_id)->first();

        if($department_row){
            return response()->json('Already in this Department');
            
        } else {
            $member->departments()->attach($department_id);
            return response()->json('Added Successfully');
        }
    }


    /**
     * 
     *Mark a selected member present.
     * 
     */
    public function markAttendance(Request $request, $id)
    {

        $attendace_id = $request->input('attendace_id');

        $member = Member::find($id);

        $attendace_row = $member->attendaces()->where('attendace_id', $attendace_id)->first();

        if($attendace_row){
            return response()->json('Already marked present');
            
        } else {
            $member->attendaces()->attach($attendace_id);
            return response()->json('Marked Successfully');
        }
    }

    /**
     * 
     *Get all events a selected member was present at.
     * 
     */
    public function getAttendances($id)
    {
        $attendaces_event = [];
        
        $member = Member::where('id', $id)->first();
        $attendaces_id = $member->attendaces;

        $counter = 0;

        foreach ($attendaces_id as $att) {
            $id = $att->id;
            $attendance = Attendace::where('id', $id)->with('event')->get();
            $attendaces_event[$counter] = [$attendance];
            $counter++;
        }

        return response()->json([
            'attendaces' => $attendaces_event,
        ], 200);

    }
}
