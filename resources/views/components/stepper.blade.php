@props(['current' => 1])

<!-- Stepper Component -->
<div class="stepper-wrap mb-10" {{ $attributes }}>
    <!-- Connecting Line -->
    <div class="stepper-line">
        @if ($current == 1)
        @elseif ($current == 2)
            <div style="height: 100%; width: 50%; background-color: var(--color-brand);"></div>
        @else
            <div style="height: 100%; width: 100%; background-color: var(--color-brand);"></div>
        @endif
    </div>
    
    <!-- Step 1: Akun -->
    <div class="step-item">
        <div class="step-circle {{ $current > 1 ? 'done' : ($current == 1 ? 'active' : 'inactive') }}">
            @if ($current > 1)
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            @else
                1
            @endif
        </div>
        <div class="step-label {{ $current > 1 ? 'done' : ($current == 1 ? 'active' : 'inactive') }}">AKUN</div>
    </div>
    
    <!-- Step 2: Data Usaha -->
    <div class="step-item">
        <div class="step-circle {{ $current > 2 ? 'done' : ($current == 2 ? 'active' : 'inactive') }}">
            @if ($current > 2)
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            @else
                2
            @endif
        </div>
        <div class="step-label {{ $current > 2 ? 'done' : ($current == 2 ? 'active' : 'inactive') }}">DATA USAHA</div>
    </div>
    
    <!-- Step 3: Konfirmasi -->
    <div class="step-item">
        <div class="step-circle {{ $current == 3 ? 'active' : 'inactive' }}">
            3
        </div>
        <div class="step-label {{ $current == 3 ? 'active' : 'inactive' }}">KONFIRMASI</div>
    </div>
</div>
