<div class="empty-state">
    @if(isset($icon))
        <div class="empty-state-icon">
            {{ $icon }}
        </div>
    @elseif(isset($iconClass))
        <div class="empty-state-icon">
            <i class="{{ $iconClass }}"></i>
        </div>
    @endif
    
    @if(isset($title))
        <h3 class="empty-state-text">{{ $title }}</h3>
    @endif
    
    @if(isset($message))
        <p class="empty-state-subtext">{{ $message }}</p>
    @endif
    
    @if(isset($action))
        <a href="{{ $action['url'] ?? '#' }}" class="empty-state-action">
            {{ $action['text'] ?? 'Action' }}
        </a>
    @endif
    
    {{ $slot ?? '' }}
</div>
