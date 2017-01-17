<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Motif;
use Response;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ids = \DB::table('tblmotif')
          ->select('strMotiId')
          ->orderBy('strMotiId', 'desc')
          ->first();

      if ($ids == null) {
        $newID = $this->smartCounter("MOTIF0000");
      }else{
        $newID = $this->smartCounter($ids->strMotiId);
      }

      $motifs = Motif::withTrashed()->get();

      return view('maintenance/motif')
        ->with('newID', $newID)
        ->with('motifs', $motifs);
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
        $rules = ['motif_id' => 'required',
                  'motif_name' => 'required'];

        $this->validate($request, $rules);
        $motif = new Motif;
        $motif->strMotiId = $request->motif_id;
        $motif->strMotiName = $request->motif_name;
        $motif->txtMotiDesc = $request->motif_description;
        $motif->save();

        return redirect('motif')
          ->with('alert-success', 'Motif was successfully added.');
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
        $motif = Motif::find($id);
        return Response::json($motif);
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
      $motif = Motif::find($id);
      $name = $motif->strMotiName;
      $motif->delete();

      return redirect('motif')->with('alert-success', 'Motif '. $name .' was successfully deleted.');
    }

    public function motif_update(Request $request)
    {
      $rules = ['motif_id' => 'required',
                'motif_name' => 'required'];

      $id = $request->motif_id;

      $this->validate($request, $rules);
      $motif = Motif::find($id);
      $motif->strMotiName = $request->motif_name;
      $motif->txtMotiDesc = $request->motif_description;
      $motif->save();

      return redirect('motif')->with('alert-success', 'Motif ' . $id . ' was successfully updated.');
    }

    public function motif_restore(Request $request)
    {
      $id = $request->motif_id;
      $motif = Motif::onlyTrashed()->where('strMotiId', '=', $id)->firstOrFail();
      $motif->restore();

      return redirect('motif')->with('alert-success', 'Motif ' . $id . ' was successfully restored.');
    }
}
