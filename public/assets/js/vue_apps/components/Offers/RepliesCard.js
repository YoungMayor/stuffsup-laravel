import MediaCard from "../MediaCard.js";

export default {
    components: {
        'media-card': MediaCard
    },

    mixins: [
        //
    ],

    props: {
        reply: {
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
                from: this.reply.from,
                posted: this.reply.posted,
                text: this.reply.reply
            }
        }
    },

    mounted: function() {
        //
    },

    template: `
<media-card
    :details="parsed_details"
></media-card>
    `
};