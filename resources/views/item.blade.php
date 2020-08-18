@extends('layouts.main')

@include('mixins.aos')

@push('styles')
@css(Article-Dual-Column)
@endpush

@section('title')
Sales Details
@endsection

@section('content')
<!-- Start: Article Dual Column -->
<div class="article-dual-column" id="item-details">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Start: Intro -->
            <div class="intro">
                <h1 class="text-center">
                    {{ $item->title }}
                </h1>

                <!-- Start: Date and Author -->
                <p class="text-center">
                    <span class="by">
                        by
                    </span>
                    <a href="{{ $item->seller->user_link }}">
                        {{ $item->seller->profile->full_name }}}}
                    </a>
                    <span class="d-inline-block date">
                        {{ $item->created_at->format('M jS, Y - H:ia') }}
                    </span>
                </p>
                <!-- End: Date and Author -->

                <figure class="figure text-center w-100">
                    <img
                        class="rounded img-fluid figure-img"
                        :src="opened_image.src">
                    <figcaption class="figure-caption small">
                        @{{ opened_image.caption }}
                    </figcaption>
                </figure>

                <!-- Start: Item Image Previews -->
                <div class="row no-gutters flex-row flex-nowrap overflow-auto">
                    @foreach ($item->images as $image)
                        <div
                            class="col-3 col-sm-2 col-xl-1 p-1 shadow-sm bg-light">
                            <div
                                data-full="{{ $image->image_meta['links']['full'] }}"
                                data-preview="{{ $image->image_meta['links']['preview'] }}"
                                data-caption="{{ $image->image_meta['caption'] }}"
                                @click="loadImage"
                                :style="preview_style_object('{{ $image->image_meta['links']['preview'] }}')"
                            ></div>
                        </div>
                    @endforeach
                </div>
                <!-- End: Item Image Previews -->
            </div>
            <!-- End: Intro -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-lg-3 offset-md-1">
            <div class="table-responsive table-borderless small m-0">
                <table class="table table-bordered table-sm">
                    <tbody class="m-0">
                        <tr>
                            <td>
                                <i class="fa fa-phone"></i>
                            </td>
                            <td>
                                <a
                                    class="btn btn-outline-secondary btn-sm"
                                    role="button"
                                    href="tel:{{ $item->phone }}"
                                    target="_blank">
                                    {{ $item->phone }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <i class="fas fa-truck"></i>
                            </td>
                            <td>
                                @foreach ($item->locations as $location)
                                    {{ $location->state_name }} ({{ $location->location }})
                                    <br/>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <i class="fas fa-mail-bulk"></i>
                            </td>
                            <td>
                                {{ $item->is_public ? 'Public' : 'Private' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-hidden">
                <p data-aos="zoom-in-up" data-aos-duration="1000">
                    {!! $item->description !!}
                </p>
            </div>
        </div>

        <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0">
            @auth
                <create-offer
                    target="{{ $item->create_offer_link }}"
                ></create-offer>
            @endauth

            <h4 class="text-center">
                Offers
            </h4>

            @if ($item->is_public || $item->i_am_seller)
                <!-- Start: Item offers -->
                <div class="row">
                    <div class="col-12">
                        <offers-card
                            v-for="offer, key in offers"
                            :key="key"
                            :offer="offer"
                        ></offers-card>
                    </div>

                    <content-loader
                        :list="offers"
                        icon="fas fa-mail-bulk"
                        label="More Offers"
                        target="{{ $item->item_offers_link }}"
                    ></content-loader>
                </div>
                <!-- End: Item offers -->
            @else

            @endif
        </div>
    </div>
</div>
<!-- End: Article Dual Column -->
@endsection

@push('scripts')
@js_m(vue_apps/item)
@endpush
