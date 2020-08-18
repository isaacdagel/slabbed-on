@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full">
        <div>
            <img class="mx-auto h-12 w-auto" src="/images/calendar.svg" alt="Workflow">
            <h2 class="mt-5 text-center text-6xl leading-10 text-gray-900" style="font-family: 'Niconne', cursive;">Slabbed On...</h2>
            <p class="mt-3 text-center text-sm leading-5 text-gray-600">Lookup encapsulation dates for NGC and PCGS certified coins.</p>
        </div>
        
        @livewire('cert-search')

        <div>
            <p class="mt-10 text-center text-xs leading-5 text-gray-600">
                &copy; Copyright 2020 Slabbed On.<br>This site is not affiliated, associated, authorized, endorsed by, or in any way connected with NGC or PCGS. The data on this site is not guaranteed to be accurate and in no event can we be held liable for any damage caused by its use.
            </p>
        </div>
    </div>
</div>
  
@endsection