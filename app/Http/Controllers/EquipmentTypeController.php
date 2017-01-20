<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;
use Response;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblEquipmentType')
            ->select('strEquiTypeId')
            ->orderBy('strEquiTypeId', 'desc')
            ->first();

        if ($ids == null) {
          $newTypeID = $this->smartCounter("EQUITYPE0000");
        }else{
          $newTypeID = $this->smartCounter($ids->strEquiTypeId);
        }

        $equipmentTypes = EquipmentType::withTrashed()->get();

        return view('maintenance/equipmentType')
          ->with('newTypeID', $newTypeID)
          ->with('equipmentTypes', $equipmentTypes);

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
      $rules = ['equipment_type_id' => 'required', 'equipment_type_name' => 'required | max:100'];

      $this->validate($request, $rules);
      $equipmentType = new EquipmentType;
      $equipmentType->strEquiTypeId = $request->equipment_type_id;
      $equipmentType->strEquiTypeName = $request->equipment_type_name;
      $equipmentType->txtEquiTypeDesc = $request->equipment_type_description;
      $equipmentType->save();

      return redirect('equipmentType')->with('alert-success', 'Equipment Type was successfully saved.');
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
        $equipmentType = EquipmentType::find($id);
        return Response::json($equipmentType);
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
        $equipmentType = EquipmentType::find($id);
        $name = $equipmentType->strEquiTypeName;
        $equipmentType->delete();

        return redirect('equipmentType')->with('alert-success', 'Equipment Type '. $name .' was successfully deleted.');
    }

    public function equipmentType_update(Request $request)
    {
      $rules = ['equipment_type_name' => 'required | max:100'];
      $id = $request->equipment_type_id;

      $this->validate($request, $rules);
      $equipmentType = EquipmentType::find($id);
      $equipmentType->strEquiTypeName = $request->equipment_type_name;
      $equipmentType->txtEquiTypeDesc = $request->equipment_type_description;
      $equipmentType->save();

      return redirect('equipmentType')->with('alert-success', 'Equipment Type ' . $id . ' was successfully updated.');
    }

    public function equipmentType_restore(Request $request)
    {
      $id = $request->equipment_type_id;
      $equipmentType = EquipmentType::onlyTrashed()->where('strEquiTypeId', '=', $id)->firstOrFail();
      $equipmentType->restore();

      return redirect('equipmentType')->with('alert-success', 'Equipment Type ' . $id . ' was successfully restored.');
    }
}
