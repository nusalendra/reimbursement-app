<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    {!! $reimbursementDiterimaChart->container() !!}
                </div>
            </div>
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    {!! $pengajuanReimbursementChart->container() !!}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ $pengajuanReimbursementChart->cdn() }}"></script>

    {{ $pengajuanReimbursementChart->script() }}

    <script src="{{ $reimbursementDiterimaChart->cdn() }}"></script>

    {{ $reimbursementDiterimaChart->script() }}
</x-app-layout>
