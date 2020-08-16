@extends('layouts.main')

@push('styles')
@css(aos)
@endpush

@section('title')
Market Place
@endsection

@section('content')
<h3 class="text-dark mb-1">
    Available Sales
</h3>

<div class="row" id="market-sales">
    <sales-card
        v-for="item, key in market_items"
        :key="key"
        :item="item"
    ></sales-card>

    <content-loader
        :list="market_items"
        icon="fas fa-store-alt"
        label="More Sales"
    ></content-loader>
</div>
@endsection

@push('scripts')
@js(aos)
<script>
    AOS.init({
        mirror: true
    });
</script>
@js_m(vue_apps/market)
@endpush
