import CreateOffer from "../Item/CreateOffer.js";

export default {
    components: {
        'create-offer': CreateOffer
    },

    mixins: [
        //
    ],

    props: {
        item: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            show_quick_offer: false
        }
    },

    methods: {
        //
    },

    computed: {
        //
    },

    mounted: function() {
        //
    },

    template: `
<div class="col-12 col-sm-6 col-xl-4 " data-aos="fade-down-left" data-aos-duration="500">
    <div class="card bg-white shadow m-1">
        <div class="card-header text-light bg-secondary p-2">
            <h6 class="font-weight-boldx">
                {{ item.title }}
            </h6>

            <span class="float-right small font-weight-bold">
                - {{ item.seller.name }}
            </span>
        </div>

        <div
            v-if="item.image"
            class="overflow-hidden position-relative text-center">
            <img
                class="img-fluid"
                data-aos="fade-down"
                data-aos-duration="1000"
                :src="item.image" />

            <span
                v-if="item.image_count > 1"
                data-aos="fade-up-left"
                data-aos-duration="1000"
                class="badge badge-pill badge-secondary shadow position-absolute"
                style="bottom: 3px;right: 3px;">
                +{{ item.image_count - 1 }} more
            </span>
        </div>

        <div class="card-body">
            <p data-aos="zoom-in" data-aos-duration="1000">
                {{ item.desc }}
            </p>

            <div
                data-aos="zoom-out" data-aos-duration="1000"
                class="table-responsive table-borderless small m-0">
                <table class="table table-bordered table-sm">
                    <tbody class="m-0">
                        <tr v-if="item.phone">
                            <td>
                                <i class="fa fa-phone"></i>
                            </td>

                            <td>
                                <a
                                    class="btn btn-outline-secondary btn-sm"
                                    role="button"
                                    :href="'tel:'+item.phone"
                                    target="_blank">
                                    {{ item.phone }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <i class="far fa-calendar-alt"></i>
                            </td>

                            <td>
                                {{ item.posted.date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="far fa-clock"></i>
                            </td>

                            <td>
                                {{ item.posted.time }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <i class="fas fa-truck"></i>
                            </td>

                            <td>
                                <template v-for="location in item.locations">
                                    {{ location.state }} ({{ location.region }})
                                    <br>
                                </template>
                            </td>
                        </tr>

                        <template v-if="item.public">
                            <tr>
                                <td>
                                    <i class="fas fa-mail-bulk"></i>
                                </td>

                                <td>
                                    Public
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="far fa-comments"></i>
                                </td>

                                <td>
                                    <span class="badge badge-pill badge-secondary">
                                        {{ item.offers }} offer(s)
                                    </span>
                                </td>
                            </tr>
                        </template>

                        <template v-else>
                            <tr>
                                <td>
                                    <i class="fas fa-mail-bulk"></i>
                                </td>

                                <td>
                                    Private
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer p-1">
            <div class="text-center">
                <a
                    class="btn btn-outline-info btn-sm m-1"
                    role="button"
                    :href="item.seller.link"
                    target="_blank">
                    View Seller
                </a>

                <a
                    class="btn btn-outline-info btn-sm m-1"
                    role="button"
                    :href="item.link"
                    target="_blank">
                    Open Sale
                </a>

                <button
                    v-if="item.quick"
                    class="btn btn-outline-info btn-sm m-1"
                    type="button"
                    @click="show_quick_offer = !show_quick_offer">
                    Quick Offer
                </button>
            </div>

            <create-offer
                v-if="item.quick"
                v-show="show_quick_offer"
                :target="item.quick"
            ></create-offer>
        </div>
    </div>
</div>
    `
};