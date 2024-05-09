<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 m-5 bg-white rounded shadow">
                {!! $reimbursementDiterimaChart->container() !!}
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 m-5 bg-white rounded shadow">
                {!! $pengajuanReimbursementChart->container() !!}
            </div>
        </div>
    </div>
    <script src="{{ $pengajuanReimbursementChart->cdn() }}"></script>

    {{ $pengajuanReimbursementChart->script() }}

    <script src="{{ $reimbursementDiterimaChart->cdn() }}"></script>

    {{ $reimbursementDiterimaChart->script() }}
</x-app-layout>
