@extends('layouts.app')
@section('content')
    <x-content-wrapper>
        <x-card>
            <div class="flex space-x-3 items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Add Volunteer') }}
                </h2>
                <x-alert-message />
            </div>
            <div class="mt-5">
                <form action="{{ $volunteer->id ? route('volunteers.update', $volunteer->id) : route('volunteers.store') }}"
                    autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ $volunteer->id ? method_field('PUT') : '' }}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="grid-cols-1">
                            <x-input-label for="name" :required="true" :value="__('Volunteer Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $volunteer->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="email" :required="true" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $volunteer->email)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="phone_number" :required="true" :value="__('Phone Number')" />
                            <x-text-input id="phone_number" name="phone_number" type="number" class="mt-1 block w-full"
                                :value="old('phone_number', $volunteer->phone_number)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="address" :required="true" :value="__('address')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $volunteer->address)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label for="password" :required="true" :value="__('Password')" />
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full"
                                :value="old('password')" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div class="grid-cols-1">
                            <x-input-label :required="true" :value="__('Status')" />
                            <div class="flex space-x-3 items-center">
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="Active"
                                        {{ old('status', $volunteer->status) == 'Active' ? 'checked' : '' }} />
                                    <span class="text-white-dark">Active</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input name="status" type="radio" class="mt-1 h-5 w-5 form-radio" value="InActive"
                                        {{ old('status', $volunteer->status) == 'InActive' || old('status', $volunteer->status) == null ? 'checked' : '' }} />
                                    <span class="text-white-dark">In Active</span>
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <div>
                            <x-input-label :value="__('Profile Photo')" />
                            <x-text-input id="profile_photo" name="profile_photo" type="file"
                                class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end space-x-2">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('volunteers.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </x-card>
    </x-content-wrapper>
@endsection
