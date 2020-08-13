@if ($should_render)
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $active_class }}" href="{{ $href }}" {!! $menu['more'] ?? '' !!}>
            <i class="{{ $menu['icon'] }}"></i>
            <span>
                {{ $menu['label'] }}
            </span>
        </a>
    </li>
@endif
