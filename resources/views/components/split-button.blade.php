<a
    class="btn btn-{{ $type }} rounded-pill btn-icon-split m-2"
    role="button"
    href="{{ $link }}"
    {{ $attributes }}>
    <span class="text-white-50 icon shadow-sm rounded-pill">
        <i class="{{ $icon }}"></i>
    </span>

    <span class="text-white text">
        {{ $label }}
    </span>
</a>
