<?php

namespace App\Http\Controllers;

use App\DataTables\MasjidsDataTable;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MasjidsDataTable $dataTable)
    {
        return $dataTable->render('masjid.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masjid = new Masjid();
        return view('masjid.form', compact('masjid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'masjid_name' => 'required',
            'address_1' => 'required',
            'district' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'status' => 'required'
        ]);
        $data['address_2'] = $request->get('address_2');
        $masjid = Masjid::create($data);
        return Redirect::route('masjids.edit',$masjid->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Masjid created successfully'
        ],);
    }

    /**
     * Display the specified resource.
     */
    public function show(Masjid $masjid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masjid $masjid)
    {
        return view('masjid.form', compact('masjid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Masjid $masjid)
    {
        $data = $request->validate([
            'masjid_name' => 'required',
            'address_1' => 'required',
            'district' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'status' => 'required'
        ]);
        $data['address_2'] = $request->get('address_2');
        $masjid->update($data);
        return Redirect::route('masjids.edit',$masjid->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Masjid Details Updated successfully'
        ],);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masjid $masjid)
    {
        $masjid->delete();
        return Redirect::route('masjids.index')->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Masjid Deleted successfully'
        ],);
    }
}