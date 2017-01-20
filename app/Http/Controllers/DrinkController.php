<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drink;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ids = \DB::table('tbldrink')
          ->select('strDrinkId')
          ->orderBy('strDrinkId', 'desc')
          ->first();

      if ($ids == null) {
        $newID = $this->smartCounter("DRK0000");
      }else{
        $newID = $this->smartCounter($ids->strDrinkId);
      }

      $drinks = Drink::withTrashed()->get();

      return view('maintenance/drink')
        ->with('newID', $newID)
        ->with('drinks', $drinks);
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
        //
        $rules = ['drink_id' => 'required',
                  'drink_name' => 'required'];

        $this->validate($request, $rules);
        $drink = new Drink;
        $drink->strDrinkId = $request->drink_id;
        $drink->strDrinkName = $request->drink_name;
        $drink->txtDrinkDesc = $request->drink_description;
        $drink->save();

        return redirect('drink')
          ->with('alert-success', 'Drink was successfully added.');
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
}
