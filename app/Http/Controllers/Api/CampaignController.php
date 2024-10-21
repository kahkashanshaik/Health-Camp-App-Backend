<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignListResource;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    // List Campaigns
    public function list(Request $requset)
    {
        $statusFilter = 'all';
        $orderBy = 'asc';
        $search = '';
        $filters = $requset->all();

        if(count($filters) > 0)
        {
            $orderBy = isset($filters['orderBy']) ? $filters['orderBy'] : 'asc';
            $statusFilter = isset($filters['status']) ? $filters['status'] : 'all';
            $search = isset($filters['search']) ? $filters['search'] : '';
        }
        $campaigns = Campaign::with('masjid')->status($statusFilter)->where(function ($query) use ($search) {
            if(!empty($search)) {
                $query->where('campaign_name', 'like', '%' . $search . '%')
                ->orWhere('campaign_description', 'like', '%' . $search . '%')
                ->orWhereHas('masjid', function($query) use($search) {
                    if(!empty($search)) {
                        $query->where('masjid_name', 'like', '%' . $search . '%')
                        ->orWhere('address_1', 'like', '%' . $search . '%');
                    }
                });
            }
        })->orderBy('id' , $orderBy)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Campaigns List',
            'data' => CampaignListResource::collection($campaigns),
            'test' => $search
        ], Response::HTTP_OK);
    }

    // Get Campaign
    public function get($id)
    {
        $campaign = Campaign::find($id);
        if(!$campaign)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Campaign not found',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Campaign Details',
            'data' => new CampaignListResource($campaign),
        ], Response::HTTP_OK);
    }
}