import Vue from './vue_eb.js'
import CreateOffer from './components/Item/CreateOffer.js';
import ContentLoader from './components/ContentLoader.js';
import OffersCard from './components/Item/OffersCard.js';
import PagePreload from './components/PagePreload.js';
import ElementTerminate from './components/ElementTerminate.js';
import ClosedSign from './components/ClosedSign.js';

Window.ITEM = new Vue({
    el: "#sales-details",

    mixins: [
        //
    ],

    components: {
        'create-offer': CreateOffer,
        'content-loader': ContentLoader,
        'offers-card': OffersCard,
        'page-preload': PagePreload,
        'element-terminate': ElementTerminate,
        'closed-sign': ClosedSign
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
            price: '',
            is_public: false,
            description: '',
            new_offer: false,
            get_offers: false,
            terminate: false,
            terminated: false,

            sale_closed: false,
        }
    },

    computed: {
        negotiation_type_label: function() {
            return this.page_details.is_public ? 'Public' : 'Private';
        },

        price_formatted: function() {
            return new Intl.NumberFormat('en-NG', {
                style: 'currency',
                currency: 'NGN'
            }).format(this.page_details.price);
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