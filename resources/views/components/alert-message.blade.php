@if (!empty(session('status')))
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
        class="absolute top-0 z-50 right-0 px-5 py-4 rounded-l-md  text-sm btn btn-{{ session('color') }} font-semibold text-white">
        {{ __(session('message')) }}</p>
@endif
