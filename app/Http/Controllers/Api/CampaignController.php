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
        $statusFilter = '';
        $filters = $requset->all();
        $statusFilter = count($filters) > 0 && isset($filters['status']) ? $filters['status'] : '';
        $campaigns = Campaign::query()->status($statusFilter)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Campaigns List',
            'data' => CampaignListResource::collection($campaigns),
        ], Response::HTTP_OK);
    }
}
