import Vue from './vue_eb.js'
import CreateOffer from './components/Item/CreateOffer.js';
import ContentLoader from './components/ContentLoader.js';
import OffersCard from './components/Item/OffersCard.js';
import PagePreload from './components/PagePreload.js';

Window.ITEM = new Vue({
    el: "#sales-details",

    mixins: [
        //
    ],

    components: {
        'create-offer': CreateOffer,
        'content-loader': ContentLoader,
        'offers-card': OffersCard,
        'page-preload': PagePreload
    },

    data: {
        opened_image: {
            src: '',
            caption: ''
        },
        offers: {},
        page_details: {
            title: '',
            seller: {
                link: '',
                name: ''
            },
            posted: {
                date: '',
                time: ''
            },
            images: [],
            phone: '',
            locations: [],
            is_public: false,
            description: '',
            new_offer: false,
            get_offers: false
        }
    },

    computed: {
        negotiation_type_label: function() {
            return this.page_details.is_public ? 'Public' : 'Private';
        }
    },

    methods: {
        preview_style_object: function(img) {
            return {
                height: '0',
                backgroundImage: `url('${img}')`,
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat',
                backgroundSize: 'contain',
                paddingBottom: '100%'
            }
        },
        loadImage: function(image) {
            this.$set(this.opened_image, 'src', image.links.full);
            this.$set(this.opened_image, 'caption', image.caption);
        }
    },

    mounted: function() {
        //
    }
});

export default Window.ITEM;