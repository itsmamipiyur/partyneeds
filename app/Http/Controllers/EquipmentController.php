<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;
use App\Equipment;
use Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $idss = \DB::table('tblEquipment')
           ->select('strEquiId')
           ->orderBy('strEquiId', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("EQUI0000");
       }else{
         $newID = $this->smartCounter($idss->strEquiId);
       }

       $equiTypes = EquipmentType::orderBy('strEquiTypeName')->pluck('strEquiTypeName', 'strEquiTypeId');
       $equipments = Equipment::withTrashed()->get();

      return view('maintenance/equipment')
        ->with('newID', $newID)
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
      $equipment->strEquiEquiTypeId = trim($request->equipment_type);
      $equipment->save();

      return redirect('equipment')->with('alert-success', 'Equipment was successfully saved.');
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
        $equipment = Equipment::find($id);
        return Response::json(['strEquiId' => $equipment->strEquiId,
                              'strEquiName' => $equipment->strEquiName,
                              'txtEquiDesc' => $equipment->txtEquiDesc,
                              'strEquiTypeName' => $equipment->equipmentType->strEquiTypeName]);

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
      $equipment = Equipment::find($id);
      $name = $equipment->strEquiName;
      $equipment->delete();

      return redirect('equipment')->with('alert-success', 'Equipment '. $name .' was successfully deleted.');
    }

    public function equipment_update(Request $request)
    {
      $rules = ['equipment_name' => 'required | max:100',
                'equipment_type' => 'required'];

      $this->validate($request, $rules);
      $equipment = Equipment::find($request->equipment_id);
      $equipment->strEquiName = trim($request->equipment_name);
      $equipment->txtEquiDesc = trim($request->equipment_description);
      $equipment->strEquiEquiTypeId = trim($request->equipment_type);
      $equipment->save();

      return redirect('equipment')->with('alert-success', 'Equipment ' . $request->equipment_id . ' was successfully updated.');
    }

    public function equipment_restore(Request $request)
    {
      $id = $request->equipment_id;
      $equipment = Equipment::onlyTrashed()->where('strEquiId', '=', $id)->firstOrFail();
      $equipment->restore();

      return redirect('equipment')->with('alert-success', 'Equipment ' . $id . ' was successfully restored.');
    }
}
