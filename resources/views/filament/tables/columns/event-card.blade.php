<div class="bg-white rounded-xl shadow-sm overflow-hidden h-full">
    {{-- Image Section --}}
    <div class="relative aspect-[16/9]">
        <img 
            src="{{ $getRecord()->image_url ?? asset('images/placeholder.jpg') }}" 
            alt="{{ $getRecord()->name ?? 'Event Image' }}"
            class="w-full h-full object-cover"
        />
        @if($getRecord()->status)
        <div class="absolute top-3 right-3">
            <span @class([
                'px-2 py-1 rounded-full text-xs font-medium',
                'bg-success-500 text-white' => $getRecord()->status === 'selesai',
                'bg-warning-500 text-white' => $getRecord()->status === 'sedang berlangsung',
                'bg-danger-500 text-white' => $getRecord()->status === 'dibatalkan',
                'bg-info-500 text-white' => $getRecord()->status === 'ditunda',
                'bg-gray-500 text-white' => $getRecord()->status === 'belum mulai',
            ])>
                {{ $getRecord()->status }}
            </span>
        </div>
        @endif
    </div>

    {{-- Content Section --}}
    <div class="p-4">
        <h3 class="text-lg font-semibold line-clamp-1 mb-2">
            {{ $getRecord()->name ?? 'Untitled Event' }}
        </h3>
        
        <div class="space-y-2 text-sm text-gray-600">
            @if($getRecord()->lokasi)
            <div class="flex items-center gap-2">
                <x-heroicon-m-map-pin class="w-4 h-4" />
                <span class="line-clamp-1">{{ $getRecord()->lokasi }}</span>
            </div>
            @endif
            
            @if($getRecord()->start_date)
            <div class="flex items-center gap-2">
                <x-heroicon-m-calendar class="w-4 h-4" />
                <span>{{ \Carbon\Carbon::parse($getRecord()->start_date)->format('d M Y') }}</span>
            </div>
            @endif

            @if($getRecord()->jam_mulai)
            <div class="flex items-center gap-2">
                <x-heroicon-m-clock class="w-4 h-4" />
                <span>{{ \Carbon\Carbon::parse($getRecord()->jam_mulai)->format('H:i') }}</span>
            </div>
            @endif
        </div>

        {{-- Footer Section --}}
        <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-1 text-gray-600">
                <x-heroicon-m-users class="w-4 h-4" />
                <span class="text-sm">{{ $getRecord()->visit_count ?? 0 }} pengunjung</span>
            </div>
            
            <div class="flex gap-2">
                @if($getRecord()->getActions())
                    @foreach ($getRecord()->getActions() as $action)
                        {{ $action }}
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>