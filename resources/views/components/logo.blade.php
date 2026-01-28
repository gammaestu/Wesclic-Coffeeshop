{{-- Coffee Shop Logo - Modern Earthy Theme --}}
<svg class="{{ $class ?? 'h-12 w-12' }}" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
    {{-- Coffee Bean Shape --}}
    <ellipse cx="50" cy="50" rx="35" ry="45" fill="#B08968" opacity="0.9"/>
    <ellipse cx="50" cy="50" rx="30" ry="40" fill="#D4A373"/>
    
    {{-- Bean Center Line --}}
    <path d="M 50 15 Q 45 30 50 50 Q 55 70 50 85" stroke="#3A3A3A" stroke-width="2" fill="none" opacity="0.3"/>
    
    {{-- Coffee Cup Silhouette --}}
    <path d="M 30 60 L 30 75 Q 30 80 35 80 L 65 80 Q 70 80 70 75 L 70 60" stroke="#A3B18A" stroke-width="3" fill="none"/>
    <path d="M 35 60 L 35 70 Q 35 75 40 75 L 60 75 Q 65 75 65 70 L 65 60" fill="#A3B18A" opacity="0.3"/>
    
    {{-- Steam Lines --}}
    <path d="M 40 50 Q 42 45 40 40" stroke="#3A3A3A" stroke-width="2" fill="none" opacity="0.4" stroke-linecap="round"/>
    <path d="M 50 50 Q 52 45 50 40" stroke="#3A3A3A" stroke-width="2" fill="none" opacity="0.4" stroke-linecap="round"/>
    <path d="M 60 50 Q 62 45 60 40" stroke="#3A3A3A" stroke-width="2" fill="none" opacity="0.4" stroke-linecap="round"/>
    
    {{-- Decorative Leaves --}}
    <path d="M 20 35 Q 15 30 20 25 Q 25 30 20 35" fill="#A3B18A" opacity="0.6"/>
    <path d="M 80 35 Q 85 30 80 25 Q 75 30 80 35" fill="#A3B18A" opacity="0.6"/>
</svg>