<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;

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
      $equipmentType->txtEquiTypeDesc = $request->equipment_type_desc;
      $equipmentType->save();

      return redirect('equipment')->with('alert-success', 'Equipment Type was successfully saved.');
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
        $customer->delete();

        return redirect('equipment')->with('alert-success', 'Customer '. $name .' was successfully deleted.');
    }

    public function equipmentType_update(Request $request)
    {
      $rules = ['equipment_type_name' => 'required | max:100'];
      $id = $request->equipment_type_id;

      $this->validate($request, $rules);
      $equipmentType = EquipmentType::find($id);
      $equipmentType->strEquiTypeName = $request->equipment_type_name;
      $equipmentType->txtEquiTypeDesc = $request->equipment_type_desc;
      $equipmentType->save();

      return redirect('equipment')->with('alert-success', 'Equipment Type ' . $id . ' was successfully updated.');
    }

    public function equipmentType_restore(Request $request)
    {
      $id = $request->customer_id;
      $customer = Customer::onlyTrashed()->where('strCustId', '=', $id)->firstOrFail();
      $customer->restore();

      return redirect('equipment')->with('alert-success', 'Customer ' . $id . ' was successfully restored.');
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
