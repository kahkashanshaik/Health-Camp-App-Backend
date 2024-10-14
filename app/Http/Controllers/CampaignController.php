<?php

namespace App\Http\Controllers;

use App\DataTables\CampaignsDataTable;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\Masjid;
use App\Models\User;
use Illuminate\Http\Request;
use Plank\Mediable\Facades\MediaUploader;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CampaignsDataTable $dataTable)
    {
        return $dataTable->render('campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campaign = new Campaign();
        return view('campaign.form')->with([
            'campaign' => $campaign,
            'masjids' => Masjid::where('status', 'Active')->get(),
            'volunteers' => User::where('role', 'Volunteer')->where('status','Active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampaignRequest $request)
    {
        $data  = $request->validated();
        $data['campaign_description'] = $request->campaign_description;
        $data['location'] = $request->location;
        $campaign = Campaign::create($data);
        if($request->hasFile('campaign_featured_image')) {
            $media = MediaUploader::fromSource($request->file('campaign_featured_image'))->toDestination('public', 'images/campaign')->useFilename(Str::uuid())->upload();
            $campaign->attachMedia($media, 'campaign_featured_image');
        }
        return redirect()->route('campaigns.edit', $campaign->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Campaign Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = Campaign::findOrFail($id);
         return view('campaign.form')->with([
            'campaign' => $campaign,
            'start_date' => $campaign->start_date->format('Y-m-d'),
            'masjids' => Masjid::where('status', 'Active')->get(),
            'volunteers' => User::where('role', 'Volunteer')->where('status','Active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CampaignRequest $request, string $id)
    {
        $data = $request->validated();
        $data['campaign_description'] = $request->campaign_description;
        $data['location'] = $request->location;
        $campaign = Campaign::findOrFail($id);
        $campaign->update($data);
        if($request->hasFile('campaign_featured_image')) {
            if($campaign->media()->first()) {
                $campaign->media()->first()->delete();
            }
            $media = MediaUploader::fromSource($request->file('campaign_featured_image'))->toDestination('public', 'images/campaign')->useFilename(Str::uuid())->upload();
            $campaign->attachMedia($media, 'campaign_featured_image');
        }
        return redirect()->route('campaigns.edit', $campaign->id)->with([
            'status' => "success",
            'color' => "primary",
            'message' => 'Campaign Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        if($campaign->media()->first()) {
            $campaign->media()->first()->delete();
        }
        $campaign->delete();
        return redirect()->route('campaigns.index')->with([
            'status' => "success",
            'color' => "danger",
            'message' => 'Campaign Deleted Successfully'
        ]);
    }
}