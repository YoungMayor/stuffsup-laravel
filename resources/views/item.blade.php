@extends('layouts.main')

@include('mixins.aos')

@push('styles')
@css(Article-Dual-Column)
@css(pre-loader)
@endpush

@section('title')
Sales Details
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
                        <div
                            class="col-3 col-sm-2 col-xl-1 p-1 shadow-sm bg-light"
                            v-for="image in page_details.images">
                            <div
                                @click="loadImage(image)"
                                :style="preview_style_object(image.links.preview)"
                            ></div>
                        </div>
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
                                        :href="'tel:'+page_details.phone"
                                        target="_blank">
                                        @{{ page_details.phone }}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <i class="fas fa-truck"></i>
                                </td>
                                <td>
                                    <template
                                        v-for="location in page_details.locations">
                                        @{{ location.state }} (@{{ location.location }}) <br/>
                                    </template>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <i class="fas fa-mail-bulk"></i>
                                </td>
                                <td>
                                    @{{ negotiation_type_label }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <i class="fas fa-cash-register"></i>
                                </td>
                                <td>
                                    @{{ price_formatted }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="overflow-hidden">
                    <p data-aos="zoom-in-up" data-aos-duration="1000">
                        @{{ page_details.description }}
                    </p>
                </div>
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

                    <create-offer
                        v-if="page_details.new_offer"
                        :target="page_details.new_offer"
                    ></create-offer>
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
