@extends('layouts.app')
@section('content')
    <x-content-wrapper>
        <x-card>
            <div class="flex space-x-3 items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Add Campaign') }}
                </h2>
                <x-alert-message />
            </div>
            <div class="mt-5">
                <form action="{{ $campaign->id ? route('campaigns.update', $campaign->id) : route('campaigns.store') }}"
                    autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ $campaign->id ? method_field('PUT') : '' }}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        {{-- Campaign Name --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label for="campaign_name" :required="true" :value="__('Campaign Name')" />
                            <x-text-input id="campaign_name" name="campaign_name" type="text" class="mt-1 block w-full"
                                :value="old('campaign_name', $campaign->campaign_name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('campaign_name')" />
                        </div>
                        {{-- Featured Image --}}
                        <div>
                            <x-input-label :required="true" :value="__('Featured Image')" />
                            <x-text-input id="campaign_featured_image" name="campaign_featured_image" type="file"
                                class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('campaign_featured_image')" />
                        </div>
                        {{-- Email --}}
                        <div class="col-span-2 w-full">
                            <x-input-label for="campaign_description" :value="__('Campaign Description')" />
                            <textarea id="campaign_description" rows="3" name="campaign_description" class="mt-1 form-textarea block w-full">{{ old('campaign_description', $campaign->campaign_description) }}</textarea>
                        </div>
                        {{-- Masjid --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label :required="true" :value="__('Masjid')" />
                            <select class="mt-1 form-select block w-ful js-choice" id="masjid_id" name="masjid_id">
                                <option value="">Select Masjid</option>
                                @foreach ($masjids as $masjid)
                                    <option value="{{ $masjid->id }}"
                                        {{ old('masjid_id', $campaign->masjid_id) == $masjid->id ? 'selected' : '' }}>
                                        {{ $masjid->masjid_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        {{-- Volunteers --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label for="volunteers" :required="true" :value="__('Volunteer')" />
                            <select class="mt-1  block w-full choices-multiple" multiple id="volunteers"
                                name="volunteers[]">
                                <option value="">Select Volunteer</option>
                                @foreach ($volunteers as $volunteer)
                                    <option {{ in_array($volunteer->id, $campaign->volunteers ?? []) ? 'selected' : '' }}
                                        value="{{ $volunteer->id }}">
                                        {{ $volunteer->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('volunteers')" />
                        </div>
                        {{-- Start Date --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label for="start_date" :required="true" :value="__('Start Date')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                :value="old(
                                    'start_date',
                                    isset($campaign->start_date) ? $campaign->start_date->format('Y-m-d') : '',
                                )" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        {{-- End date --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label for="end_date" :required="true" :value="__('End Date')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                                :value="old(
                                    'end_date',
                                    isset($campaign->start_date) ? $campaign->start_date->format('Y-m-d') : '',
                                )" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                        {{-- Location --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label for="location" :required="false" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                :value="old('location', $campaign->location)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                        {{-- Status --}}
                        <div class="col-span-2 lg:col-span-1">
                            <x-input-label :required="true" :value="__('Status')" />
                            <div class="flex space-x-3 items-center">
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="Active"
                                        {{ old('status', $campaign->status) == 'Active' ? 'checked' : '' }} />
                                    <span class="text-white-dark">Active</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="InActive"
                                        {{ old('status', $campaign->status) == 'InActive' || old('status', $campaign->status) == null ? 'checked' : '' }} />
                                    <span class="text-white-dark">In Active</span>
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end space-x-2">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('campaigns.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </x-card>
    </x-content-wrapper>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            const element = document.querySelector('.js-choice');
            const choices = new Choices(element);

            const choices_multiple = document.querySelector('.choices-multiple');
            new Choices(choices_multiple, {
                removeItemButton: true,
            });
        });
    </script>
@endpush
