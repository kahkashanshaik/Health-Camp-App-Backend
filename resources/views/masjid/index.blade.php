@extends('layouts.app')
@section('content')
    <x-content-wrapper>
        <x-card>
            <div class="flex space-x-3 items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('All Masjids') }}
                </h2>
                <x-alert-message />
            </div>
            <div class="mb-5 mt-5">
                <div class="flex items-center gap-5 my-5 w-1/4 ">
                    <select name="status" id="status" class="form-select">
                        <option value="">-- Select Status --</option>
                        <option value="Active">Active</option>
                        <option value="InActive">Inactive</option>
                    </select>
                </div>
                {{ $dataTable->table() }}
            </div>
        </x-card>
    </x-content-wrapper>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            // Use a MutationObserver to detect when window.LaravelDataTables is initialized
            const observer = new MutationObserver((mutationsList, observer) => {
                if (window.LaravelDataTables && window.LaravelDataTables['masjids-table']) {
                    // DataTable is initialized, stop observing
                    observer.disconnect();

                    const dataTable = window.LaravelDataTables['masjids-table'];

                    // Add preXhr event to include filter values in the request
                    dataTable.on('preXhr.dt', (e, settings, data) => {
                        data.status = document.getElementById('status').value;
                    });

                    // Trigger the table refresh on filter button click
                    document.getElementById('status').addEventListener('change', () => {
                        dataTable.draw();
                    });

                    // Reset filters and refresh table
                    // document.getElementById('reset-btn').addEventListener('click', () => {
                    //     document.getElementById('filter-masjid-name').value = '';
                    //     document.getElementById('filter-date').value = '';
                    //     dataTable.draw();
                    // });
                }
            });

            // Observe changes in the window object for LaravelDataTables initialization
            observer.observe(document, {
                childList: true,
                subtree: true
            });
        });
    </script>
@endpush
