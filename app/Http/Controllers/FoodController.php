<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FoodCategory;
use App\Food;
use Response;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $idss = \DB::table('tblFood')
            ->select('strFoodId')
            ->orderBy('strFoodId', 'desc')
            ->first();

        if ($idss == null) {
          $newID = $this->smartCounter("FOOD0000");
        }else{
          $newID = $this->smartCounter($idss->strFoodId);
        }

        $foodCategories = FoodCategory::orderBy('strFoodCateName')->pluck('strFoodCateName', 'strFoodCateId');
        $foods = Food::withTrashed()->get();

       return view('maintenance/food')
         ->with('newID', $newID)
         ->with('foodCategories', $foodCategories)
         ->with('foods', $foods);

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
        $rules = ['food_name' => 'required | max:100',
                  'food_category' => 'required'];

        $this->validate($request, $rules);
        $food = new Food;

        $food->strFoodId = trim($request->food_id);
        $food->strFoodName = trim($request->food_name);
        $food->txtFoodDesc = trim($request->food_description);
        $food->strFoodFoodCateId = trim($request->food_category);
        $food->save();

        return redirect('food')->with('alert-success', 'Food was successfully saved.');
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
        $food = Food::find($id);
        return Response::json(['strFoodId' => $food->strFoodId,
                              'strFoodName' => $food->strFoodName,
                              'txtFoodDesc' => $food->txtFoodDesc,
                              'strFoodCateName' => $food->foodCategory->strFoodCateName]);

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
       $food = Food::find($id);
       $name = $food->strFoodName;
       $food->delete();

       return redirect('food')->with('alert-success', 'Food '. $name .' was successfully deleted.');
     }

     public function food_update(Request $request)
     {
       $rules = ['food_name' => 'required | max:100',
                 'food_category' => 'required'];

       $this->validate($request, $rules);
       $food = Food::find($request->food_id);
       $food->strFoodName = trim($request->food_name);
       $food->txtFoodDesc = trim($request->food_description);
       $food->strFoodFoodCateId = trim($request->food_category);
       $food->save();

       return redirect('food')->with('alert-success', 'Food ' . $request->food_id . ' was successfully updated.');
     }

     public function food_restore(Request $request)
     {
       $id = $request->food_id;
       $food = Food::onlyTrashed()->where('strFoodId', '=', $id)->firstOrFail();
       $food->restore();

       return redirect('food')->with('alert-success', 'Food ' . $id . ' was successfully restored.');
     }
}
