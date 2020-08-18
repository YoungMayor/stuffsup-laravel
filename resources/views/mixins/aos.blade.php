@push('styles')
@css(aos)
@endpush

@push('scripts')
@js(aos)
<script>
    AOS.init({
        mirror: true
    });
</script>
@endpush
