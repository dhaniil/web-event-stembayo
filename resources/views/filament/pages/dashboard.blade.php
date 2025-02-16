<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
        <div class="lg:col-span-6">
            @livewire(CompletedEventsWidget::class)
        </div>
        <div class="lg:col-span-6">
            @livewire(MonthlyEventsWidget::class)
        </div>
        
        {{-- Widget lainnya --}}
        <div class="lg:col-span-12">
            @livewire(VisitorChartWidget::class)
        </div>
    </div>
</x-filament-panels::page>