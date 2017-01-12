<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;
use App\Equipment;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $ids = \DB::table('tblEquipmentType')
           ->select('strEquiTypeId')
           ->orderBy('strEquiTypeId', 'desc')
           ->first();
       $idss = \DB::table('tblEquipment')
           ->select('strEquiId')
           ->orderBy('strEquiId', 'desc')
           ->first();

       if ($ids == null) {
         $newTypeID = $this->smartCounter("EQUITYPE0000");
       }else{
         $newTypeID = $this->smartCounter($ids->strEquiTypeId);
       }

       if ($idss == null) {
         $newID = $this->smartCounter("EQUI0000");
       }else{
         $newID = $this->smartCounter($idss->strEquiId);
       }

       $equipmentTypes = EquipmentType::withTrashed()->get();
       $equiTypes = EquipmentType::orderBy('strEquiTypeName')->pluck('strEquiTypeName', 'strEquiTypeId');
       $equipments = Equipment::withTrashed()->get();

      return view('maintenance/equipment')
        ->with('newTypeID', $newTypeID)
        ->with('newID', $newID)
        ->with('equipmentTypes', $equipmentTypes)
        ->with('equiTypes', $equiTypes)
        ->with('equipments', $equipments);
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
      $rules = ['equipment_name' => 'required | max:100',
                'equipment_type' => 'required'];

      $this->validate($request, $rules);
      $equipment = new Equipment;

      $equipment->strEquiId = trim($request->equipment_id);
      $equipment->strEquiName = trim($request->equipment_name);
      $equipment->txtEquiDesc = trim($request->equipment_description);
      $equipment->strEquiTypeId = trim($request->equipment_type);
      $equipment->save();

      return redirect('equipment')->with('alert-success', 'Equipments was successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
