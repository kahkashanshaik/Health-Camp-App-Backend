@extends('layouts.app')
@section('content')
    <x-content-wrapper>
        <x-card>
            <div class="flex space-x-3 items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Add Masjid') }}
                </h2>
                <x-alert-message />
            </div>
            <div class="mt-5">
                <form action="{{ $masjid->id ? route('masjids.update', $masjid->id) : route('masjids.store') }}"
                    autocomplete="off" method="POST">
                    @csrf
                    {{ $masjid->id ? method_field('PUT') : '' }}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="grid-cols-1">
                            <x-input-label for="masjid_name" :required="true" :value="__('Masjid Name')" />
                            <x-text-input id="masjid_name" name="masjid_name" type="text" class="mt-1 block w-full"
                                :value="old('masjid_name', $masjid->masjid_name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('masjid_name')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="address_1" :required="true" :value="__('Address 1')" />
                            <x-text-input id="address_1" name="address_1" type="text" class="mt-1 block w-full"
                                :value="old('address_1', $masjid->address_1)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('address_1')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="address_2" :required="false" :value="__('Address 2')" />
                            <x-text-input id="address_2" name="address_2" type="text" class="mt-1 block w-full"
                                :value="old('address_2', $masjid->address_2)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('address_2')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="district" :required="true" :value="__('District')" />
                            <x-text-input id="district" name="district" type="text" class="mt-1 block w-full"
                                :value="old('district', $masjid->district)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('district')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="state" :required="true" :value="__('State')" />
                            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full"
                                :value="old('state', $masjid->state)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('state')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="postcode" :required="true" :value="__('Post Code')" />
                            <x-text-input id="postcode" name="postcode" type="text" class="mt-1 block w-full"
                                :value="old('postcode', $masjid->postcode)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label :required="true" :value="__('Status')" />
                            <div class="flex space-x-3 items-center">
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="Active"
                                        {{ old('status', $masjid->status) == 'Active' ? 'checked' : '' }} />
                                    <span class="text-white-dark">Active</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="InActive"
                                        {{ old('status', $masjid->status) == 'InActive' || old('status', $masjid->status) == null ? 'checked' : '' }} />
                                    <span class="text-white-dark">In Active</span>
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end space-x-2">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('masjids.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </x-card>
    </x-content-wrapper>
@endsection
