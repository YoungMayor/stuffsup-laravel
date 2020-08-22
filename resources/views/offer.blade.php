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
<page-preload :content="page_details" id="sales-offer">
    <!-- Start: Article Dual Column -->
    <div class="article-dual-column">
        <div class="row">
            <div class="col-md-10 col-lg-3 offset-md-1">
                <div class="media flex-lg-column flex-xl-row">
                    <img
                        class="rounded-circle img-fluid mr-1"
                        :src="page_details.author.avatar"
                        width="48px">

                    <div class="media-body pl-2 border-left">
                        <h5 class="font-weight-bold mb-1">
                            <a
                                class="text-decoration-none"
                                :href="page_details.author.link"
                                target="_blank">
                                @{{ page_details.author.name }}
                            </a>
                        </h5>

                        <div class="table-responsive table-borderless">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td>
                                            <i class="fas fa-store-alt"></i>
                                        </td>
                                        <td>
                                            <span>
                                                @{{ page_details.item.title }}
                                            </span>
                                            <a
                                                class="badge badge-pill badge-info ml-1"
                                                :href="page_details.item.link"
                                                target="_blank">Open Sale</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <i class="fa fa-calendar"></i>
                                        </td>
                                        <td>
                                            @{{ page_details.posted.date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="far fa-clock"></i>
                                        </td>
                                        <td>
                                            @{{ page_details.posted.time }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <i class="far fa-comment-alt"></i>
                                        </td>
                                        <td>
                                            @{{ page_details.offer }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0">
                <closed-sign
                    v-if="page_details.closed"
                    note="Offer Closed"
                ></closed-sign>

                <!-- Start: Element Termination -->
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
                        element="Offer"
                        :target="page_details.terminate"
                        v-if="page_details.terminate"
                    ></element-terminate>

                    <textarea-form
                        v-if="page_details.new_reply"
                        :target="page_details.new_reply"
                        heading="Reply to offer"
                        placeholder="Enter reply here..."
                    ></textarea-form>
                </template>

                <template v-if="page_details.get_replies">
                    <h3 class="text-center">
                        Replies
                    </h3>

                    <!-- Start: Item offers -->
                    <div class="row">
                        <div class="col-12">
                            <replies-card
                                v-for="reply, key in replies"
                                :key="key"
                                :reply="reply"
                            ></replies-card>
                        </div>

                        {{-- <content-loader
                            :list="offers"
                            icon="fas fa-mail-bulk"
                            label="More Offers"
                            :target="page_details.get_offers"
                        ></content-loader> --}}
                    </div>
                    <!-- End: Item offers -->
                </template>
            </div>
        </div>
    </div>
    <!-- End: Article Dual Column -->
</page-preload>
@endsection

@push('scripts')
@js_m(vue_apps/offer)
@endpush
