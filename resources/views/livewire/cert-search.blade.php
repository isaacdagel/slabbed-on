<div>
    <form class="mt-6" wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
        <div class="rounded-md shadow-sm">
            <div>
                <input aria-label="Certification ID" name="cert_num" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-700 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" autofocus placeholder="Enter a NGC or PCGS cert number...">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600"
                    wire:loading.class.remove="hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                <div wire:loading.remove>Search</div>
                <div wire:loading>Searching...</div>
            </button>
        </div>
    </form>

    @if ($cert_num)
        <p class="mt-5 text-center text-sm leading-5 text-blue-500">
            @if ($date)
                {!! $api_called ? '<strong>New record added.</strong><br>' : '' !!}
                <strong>{{ $certifier }} {{ $cert_num }}</strong> was slabbed on or around <strong>{{ Carbon::parse($date)->format('F j, Y') }}</strong>.
            @else
                Sorry, we do not have any records for the cert number you entered.
            @endif
        </p>
    @endif
</div>
