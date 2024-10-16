<?php

namespace App\Http\Controllers;

use App\DataTables\VolunteersDataTable;
use App\Http\Requests\VolunteerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Plank\Mediable\Facades\MediaUploader;
use Illuminate\Support\Str;


class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VolunteersDataTable $dataTable)
    {
        return $dataTable->render('volunteer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $volunteer = new User();
        return view('volunteer.form', compact('volunteer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VolunteerRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'volunteer';

        $volunteer = User::create($data);
        if($request->hasFile('profile_photo') && !empty($request->file('profile_photo'))) {
            if( $volunteer->media()->first()) {
                 $volunteer->media()->first()->delete();
            }
            $media = MediaUploader::fromSource($request->file('profile_photo'))->toDestination('public', 'images/profiles')->useFilename(Str::uuid())->upload();
             $volunteer->attachMedia($media, 'profile_photo');
        }
        return redirect()->route('volunteers.edit', $volunteer->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Volunteer created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = User::findOrFail($id);
        return view('volunteer.form', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VolunteerRequest $request, string $id)
    {
        $data = $request->validated();
        if (!empty($data['password']))
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);
        $data['role'] = 'volunteer';
        $volunteer = User::findOrFail($id);
        $data['role'] = 'volunteer';
        $volunteer->update($data);

        if($request->hasFile('profile_photo') && !empty($request->file('profile_photo'))) {
            if($volunteer->media()->first()) {
                $volunteer->media()->first()->delete();
            }
            $media = MediaUploader::fromSource($request->file('profile_photo'))->toDestination('public', 'images/profiles')->useFilename(Str::uuid())->upload();
            $volunteer->attachMedia($media, 'profile_photo');
        }

        return redirect()->route('volunteers.edit', $volunteer->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Volunteer updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if($user->media()->first()) {
            $user->media()->first()->delete();
        }
        $user->delete();
        return redirect()->route('volunteers.index')->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Volunteer deleted successfully'
        ]);
    }
}