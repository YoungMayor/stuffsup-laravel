@extends('layouts.main')

@include('mixins.aos')

@push('styles')
@css(Article-Dual-Column)
@css(pre-loader)
@endpush

@section('title')
Item's Details
@endsection


@section('content')
<page-preload
    :content="page_details"
    id="sales-details"
    class="article-dual-column"
>
    <closed-sign
        v-if="page_details.sale_closed"
        note="Sales Closed"
    ></closed-sign>

    <template v-else>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <!-- Start: Intro -->
                <div class="intro">
                    <h1 class="text-center">
                        @{{ page_details.title }}
                    </h1>

                    <!-- Start: Date and Author -->
                    <p class="text-center">
                        <span class="by">
                            by
                        </span>
                        <a :href="page_details.seller.link">
                            @{{ page_details.seller.name }}
                        </a>
                        <span class="d-inline-block date">
                            @{{ page_details.posted.date }} - @{{ page_details.posted.time }}
                        </span>
                    </p>
                    <!-- End: Date and Author -->

                    <div
                        data-ride="carousel"
                        data-interval="false"
                        class="carousel slide"
                        id="item-images-carousel">
                        <div role="listbox" class="carousel-inner">
                            <div
                                v-for="image, index in page_details.images"
                                class="carousel-item"
                                :class="index == '0' ? 'active' :  ''">
                                <img
                                    class="d-block m-auto"
                                    :src="image.links.full"
                                    alt="Slide Image"
                                    loading="lazy" />
                            </div>
                        </div>

                        <div>
                            <a
                                href="#item-images-carousel"
                                role="button"
                                data-slide="prev"
                                class="carousel-control-prev">
                                <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                                <span class="sr-only">
                                    Previous
                                </span>
                            </a>

                            <a
                                href="#item-images-carousel"
                                role="button"
                                data-slide="next"
                                class="carousel-control-next">
                                <span aria-hidden="true" class="carousel-control-next-icon"></span>
                                <span class="sr-only">
                                    Next
                                </span>
                            </a>
                        </div>

                        <ol class="carousel-indicators">
                            <li
                                v-for="image, index in page_details.images"
                                data-target="#item-images-carousel"
                                :data-slide-to="index"
                                :class="index == '0' ? 'active' :  ''">
                            </li>
                        </ol>
                    </div>

                </div>
                <!-- End: Intro -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-lg-3 offset-md-1">
                <show-card
                    class="mb-2"
                    label="Item Cost"
                    :content="price_formatted"
                    icon="fa fa-money"
                ></show-card>

                <show-card
                    class="mb-2"
                    label="Contact Phone"
                    :content="page_details.phone"
                    icon="fa fa-phone">
                    <a
                        class="btn btn-outline-secondary btn-block btn-sm"
                        role="button"
                        :href="'tel:'+page_details.phone"
                        target="_blank">
                        Call Agent
                    </a>
                </show-card>

                <show-card
                    label="Delivery Location(s)"
                    class="mb-2"
                    icon="fas fa-truck">
                    <template
                        v-for="location in page_details.locations">
                        @{{ location.state }} (@{{ location.location }}) <br/>
                    </template>
                </show-card>

                <show-card
                    label="Negotiation Type"
                    class="mb-2"
                    icon="fas fa-mail-bulk"
                    :content="negotiation_type_label"
                ></show-card>

                <show-card aos="zoom-in-up" duration="1000" class="mb-2">
                    @{{ page_details.description }}
                </show-card>
            </div>

            <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0">
                <div role="alert" class="alert alert-warning" v-if="page_details.terminated">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="alert-heading">
                        Sale has been closed
                    </h4>
                    <span>
                        @{{ page_details.terminated }}
                    </span>
                </div>

                <template v-else>
                    <element-terminate
                        element="Sale"
                        :target="page_details.terminate"
                        v-if="page_details.terminate"
                    ></element-terminate>

                    <textarea-form
                        v-if="page_details.new_offer"
                        :target="page_details.new_offer"
                        heading="Make offer for item"
                        placeholder="Enter offer here..."
                    ></textarea-form>
                </template>

                <!-- Start: Item offers -->
                <template v-if="page_details.get_offers">
                    <h4 class="text-center">
                        Offers
                    </h4>

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
                            :target="page_details.get_offers"
                        ></content-loader>
                    </div>
                </template>
                <!-- End: Item offers -->
            </div>
        </div>
    </template>
</page-preload>
@endsection

@push('scripts')
@js_m(vue_apps/item)
@endpush
