<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Response;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblCustomer')
            ->select('strCustId')
            ->orderBy('strCustId', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("CUST0000");
        }else{
          $newID = $this->smartCounter($ids->strCustId);
        }

        $customers = Customer::withTrashed()->get();

        return view('maintenance/customer')
                    ->with('newID', $newID)
                    ->with('customers', $customers);


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
        $rules = ['first_name' => 'required',
                  'last_name' => 'required',
                  'address' => 'required',
                  'contact' => 'required'];

        $this->validate($request, $rules);
        $customer = new Customer;
        $customer->strCustId = $request->customer_id;
        $customer->strCustFirst = $request->first_name;
        $customer->strCustMiddle = $request->middle_name;
        $customer->strCustLast = $request->last_name;
        $customer->strCustAddress = $request->address;
        $customer->strCustContact = $request->contact;
        $customer->save();

        return redirect('customer')->with('alert-success', 'Customer was successfully saved.');
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
        $customer = Customer::find($id);
        return Response::json($customer);
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
        $customer = Customer::find($id);
        $name = $customer->strCustFirst .' '. $customer->strCustMiddle .' '.$customer->strCustLast;
        $customer->delete();
        return redirect('customer')->with('alert-success', 'Customer '. $name .' was successfully deleted.');
    }

    public function customer_update(Request $request)
    {
      $rules = ['first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'contact' => 'required'];

      $id = $request->customer_id;

      $this->validate($request, $rules);
      $customer = Customer::find($id);
      $customer->strCustFirst = $request->first_name;
      $customer->strCustMiddle = $request->middle_name;
      $customer->strCustLast = $request->last_name;
      $customer->strCustAddress = $request->address;
      $customer->strCustContact = $request->contact;
      $customer->save();

      return redirect('customer')->with('alert-success', 'Customer ' . $id . ' was successfully updated.');
    }

    public function customer_restore(Request $request)
    {
      $id = $request->customer_id;
      $customer = Customer::onlyTrashed()->where('strCustId', '=', $id)->firstOrFail();
      $customer->restore();

      return redirect('customer')->with('alert-success', 'Customer ' . $id . ' was successfully restored.');
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
