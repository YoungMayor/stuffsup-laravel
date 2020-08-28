@extends('layouts.main')

@push('styles')
@css(Article-Dual-Column)
@css(pre-loader)
@endpush

@section('title')
Offer's Details
@endsection


@section('content')
<page-preload :content="page_details" id="sales-offer">
    <!-- Start: Article Dual Column -->
    <div class="article-dual-column">
        <div class="row">
            <div class="col-md-10 col-lg-3 offset-md-1">
                <media-card
                    :details="parsed_media_details"
                ></media-card>

                <show-card
                    label="Item Summary"
                    :content="page_details.item.title"
                    class="mb-2">
                    <div>
                        <span>
                            @{{ page_details.item.desc }}
                        </span>
                    </div>
                    <div>
                        <a
                            class="btn btn-outline-secondary btn-block btn-sm"
                            role="button"
                            :href="page_details.item.link"
                            target="_blank">
                            Open Sale
                        </a>
                    </div>
                </show-card>
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
                        Offer has been closed
                    </h4>
                    <span>
                        @{{ page_details.terminated }}
                    </span>
                </div>

                <template v-else>
                    <element-terminate
                        element="Offer"
                        :target="page_details.terminate"
                        :success="on_close"
                        v-if="page_details.terminate"
                    ></element-terminate>

                    <textarea-form
                        v-if="page_details.new_reply"
                        :target="page_details.new_reply"
                        heading="Reply to offer"
                        placeholder="Enter reply here..."
                        field="reply"
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

                        <content-loader
                            :list="replies"
                            icon="fas fa-mail-bulk"
                            label="More Replies"
                            :target="page_details.get_replies"
                        ></content-loader>
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
