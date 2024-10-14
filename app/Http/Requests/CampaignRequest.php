<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'campaign_name' => 'required|string|max:255',
            'masjid_id' => 'required|exists:masjids,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'volunteers' => 'required|exists:users,id',
            'status' => 'required|in:Active,InActive',
            'campaign_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}