<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventType;
use Response;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ids = \DB::table('tbleventtype')
          ->select('strEvenTypeId')
          ->orderBy('strEvenTypeId', 'desc')
          ->first();

      if ($ids == null) {
        $newID = $this->smartCounter("EVNTYPE0000");
      }else{
        $newID = $this->smartCounter($ids->strEvenTypeId);
      }

      $eventTypes = EventType::withTrashed()->get();

      return view('maintenance/eventType')
        ->with('newID', $newID)
        ->with('eventTypes', $eventTypes);
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
        //Define Validation Rules
        $rules = ['event_type_id' => 'required',
                  'event_type_name' => 'required'];

        //Validate request according to defined rules
        $this->validate($request, $rules);

        //Create an instance of EventType Model
        $eventType = new EventType;

        //Passing validated request value to eventType attributes
        $eventType->strEvenTypeId = $request->event_type_id;
        $eventType->strEvenTypeName = $request->event_type_name;
        $eventType->txtEvenTypeDesc = $request->event_type_description;

        //Saving Data
        $eventType->save();

        //redirect to index
        return redirect('eventType')
          ->with('alert-success', 'Event Type was successfully added.');
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
        $eventType = EventType::find($id);
        return Response::json($eventType);
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
        $eventType = EventType::find($id);
        $name = $eventType->strEvenTypeName;
        $eventType->delete();

        return redirect('eventType')->with('alert-success', 'Event Type '. $name .' was successfully deleted.');
    }

    public function eventType_update(Request $request)
    {
      $rules = ['event_type_id' => 'required',
                'event_type_name' => 'required'];

      $id = $request->event_type_id;

      $this->validate($request, $rules);
      $eventType = EventType::find($id);
      $eventType->strEvenTypeName = $request->event_type_name;
      $eventType->txtEvenTypeDesc = $request->event_type_description;
      $eventType->save();

      return redirect('eventType')->with('alert-success', 'Event Type ' . $id . ' was successfully updated.');
    }

    public function eventType_restore(Request $request)
    {
      $id = $request->event_type_id;
      $eventType = EventType::onlyTrashed()->where('strEvenTypeId', '=', $id)->firstOrFail();
      $eventType->restore();

      return redirect('eventType')->with('alert-success', 'Event Type ' . $id . ' was successfully restored.');
    }
}
