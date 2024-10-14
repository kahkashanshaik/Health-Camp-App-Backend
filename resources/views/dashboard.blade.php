@extends('layouts.app')
@section('content')
    <x-content-wrapper>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="panel grid-cols-1">
                <div class="flex items-center justify-between dark:text-white-light mb-5">
                    <h5 class="font-semibold text-lg">Masjids</h5>
                    <a href="{{ route('masjids.index') }}">
                        {!! loadSvg('round-arrow-right') !!}
                    </a>
                </div>
                <div>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            {!! loadSvg('garage') !!}
                            <div class="px-3 flex-1">
                                <div>Total Masjids</div>
                            </div>
                            <span
                                class="text-primary font-extrabold text-lg px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">{{ $stats['total_masjids'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel grid-cols-1">
                <div class="flex items-center justify-between dark:text-white-light mb-5">
                    <h5 class="font-semibold text-lg">Volunteers</h5>
                    <a href="{{ route('volunteers.index') }}">
                        {!! loadSvg('round-arrow-right') !!}
                    </a>
                </div>
                <div>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            {!! loadSvg('shield-user') !!}
                            <div class="px-3 flex-1">
                                <div>Total Volunteers</div>
                            </div>
                            <span
                                class="text-primary font-extrabold text-lg px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">{{ $stats['total_volunteers'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-content-wrapper>
@endsection
