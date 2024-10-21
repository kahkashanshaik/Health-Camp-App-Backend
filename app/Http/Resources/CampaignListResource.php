<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CampaignListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'campaign_name' => $this->campaign_name,
            'campaign_description' => $this->campaign_description,
            'masjid' => $this->masjid,
            'start_date' => Carbon::parse($this->start_date)->format('jS F Y'),
            'end_date' => Carbon::parse($this->end_date)->format('jS F Y'),
            'location' => $this->location,
            'featured_img' => !empty($this->getMedia('campaign_featured_image')->first()) ? $this->getMedia('campaign_featured_image')->first()->getUrl() : url(Storage::url('images/campaign/default_img.jpg')),
            'status' => ucfirst($this->campaign_status),
        ];
    }

}