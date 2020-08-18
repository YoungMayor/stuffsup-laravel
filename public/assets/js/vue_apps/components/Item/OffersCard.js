import CreateOffer from "../Item/CreateOffer.js";

export default {
    components: {
        'create-offer': CreateOffer
    },

    mixins: [
        //
    ],

    props: {
        offer: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            //
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
<div class="media p-1 mb-4" data-aos="fade-left" data-aos-duration="1000">
    <img
        class="rounded-circle img-fluid mr-1"
        :src="offer.from.avatar"
        width="48px">

    <div class="media-body pl-2 border-left">
        <h5 class="font-weight-bold mb-1">
            <a
                class="text-decoration-none"
                :href="offer.from.link"
                target="_blank">
                {{ offer.from.name }}
            </a>
        </h5>

        <small>
            {{ offer.posted.date }} - {{ offer.posted.time }}
        </small>

        <p>
            {{ offer.offer }}
            <span class="badge badge-pill badge-secondary float-right">
                {{ offer.responses }} response
            </span>
        </p>

        <div>
            <a
                class="btn btn-outline-info btn-sm"
                role="button"
                :href="offer.link"
                target="_blank">
                <span>Open Offer</span>
                <i class="fa fa-external-link p-1"></i>
            </a>
        </div>

        <div class="text-center text-danger small" v-if="offer.closed">
            <i class="fa fa-warning"></i>
            <span>
                Offer has been closed by the seller
            </span>
        </div>
    </div>
</div>
    `
};