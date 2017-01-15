<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ids = \DB::table('tblStaff')
          ->select('strStafId')
          ->orderBy('strStafId', 'desc')
          ->first();

      if ($ids == null) {
        $newID = $this->smartCounter("STFF0000");
      }else{
        $newID = $this->smartCounter($ids->strStafId);
      }

      $staffs = Staff::withTrashed()->get();

      return view('maintenance/staff')
                  ->with('newID', $newID)
                  ->with('staffs', $staffs);

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
      $rules = ['first_name' => 'required',
                'last_name' => 'required'
              ];

      $this->validate($request, $rules);
      $staff = new Staff;
      $staff->strStafId = $request->staff_id;
      $staff->strStafFirst = $request->first_name;
      $staff->strStafMiddle = $request->middle_name;
      $staff->strStafLast = $request->last_name;
      $staff->save();

      return redirect('staff')->with('alert-success', 'Staff was successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $staff = Staff::find($id);
      return Response::json($staff);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $staff = Staff::find($id);
      $name = $staff->strStafFirst .' '. $staff->strStafMiddle .' '.$staff->strStafLast;
      $staff->delete();
      return redirect('staff')->with('alert-success', 'Staff '. $name .' was successfully deleted.');
    }

    public function staff_update(Request $request)
    {
      $rules = ['first_name' => 'required',
                'last_name' => 'required'];

      $id = $request->staff_id;

      $this->validate($request, $rules);
      $staff = Staff::find($id);
      $staff->strStafFirst = $request->first_name;
      $staff->strStafMiddle = $request->middle_name;
      $staff->strStafLast = $request->last_name;
      $staff->save();

      return redirect('staff')->with('alert-success', 'Staff ' . $id . ' was successfully updated.');
    }

    public function staff_restore(Request $request)
    {
      $id = $request->staff_id;
      $staff = Staff::onlyTrashed()->where('strStafId', '=', $id)->firstOrFail();
      $staff->restore();

      return redirect('staff')->with('alert-success', 'Staff ' . $id . ' was successfully restored.');
    }


    public function smartCounter($id)
    {
        $lastID = str_split($id);
        $ctr = 0;
        $tempID = "";
        $tempNew = [];
        $newID = "";
        $add = TRUE;
        for($ctr = count($lastID)-1; $ctr >= 0; $ctr--){
            $tempID = $lastID[$ctr];
            if($add){
                if(is_numeric($tempID) || $tempID == '0'){
                    if($tempID == '9'){
                        $tempID = '0';
                        $tempNew[$ctr] = $tempID;
                    }else{
                        $tempID = $tempID + 1;
                        $tempNew[$ctr] = $tempID;
                        $add = FALSE;
                    }
                }else{
                    $tempNew[$ctr] = $tempID;
                }
            }
            $tempNew[$ctr] = $tempID;
        }

        for($ctr = 0; $ctr < count($lastID); $ctr++){
            $newID = $newID . $tempNew[$ctr];
        }
        return $newID;
    }
}
