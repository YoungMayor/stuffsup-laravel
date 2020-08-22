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
                from: {
                    avatar: '#',
                    link: '#',
                    name: 'Mayor Young'
                },
                posted: {
                    date: 'May 10th, 2020',
                    time: '10:04am'
                },
                text: 'The Sample Text',
                linkx: {
                    target: '#',
                    label: 'Open This piece of shit',
                    icon: 'fa fa-external-link'
                }
            }
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
></media-card>
    `
};