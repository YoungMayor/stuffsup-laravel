import MediaCard from "../MediaCard.js";

export default {
    components: {
        'media-card': MediaCard
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
        parsed_details: function() {
            return {
                from: this.offer.from,
                posted: this.offer.posted,
                text: this.offer.offer,
                link: {
                    target: this.offer.link,
                    label: 'Open Offer',
                    icon: 'fa fa-external-link'
                }
            }
        }
    },

    mounted: function() {
        //
    },

    template: `
<media-card
    :details="parsed_details"
>
    <span class="badge badge-pill badge-secondary float-right" slot="text">
        {{ offer.responses }} response
    </span>

    <div class="text-center text-danger small" v-if="offer.closed" slot="foot">
        <i class="fa fa-warning"></i>
        <span>
            Offer has been closed by the seller
        </span>
    </div>
</media-card>
    `
};