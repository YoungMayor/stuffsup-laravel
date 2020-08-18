import Vue from './vue_eb.js'
import CreateOffer from './components/Item/CreateOffer.js';
import ContentLoader from './components/ContentLoader.js';
import OffersCard from './components/Item/OffersCard.js';

Window.ITEM = new Vue({
    el: "#item-details",

    mixins: [
        //
    ],

    components: {
        'create-offer': CreateOffer,
        'content-loader': ContentLoader,
        'offers-card': OffersCard
    },

    data: {
        opened_image: {
            src: '',
            caption: ''
        },
        offers: {}
    },

    computed: {
        //
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
        loadImage: function(e) {
            let image = e.target.dataset;

            this.$set(this.opened_image, 'src', image.full);
            this.$set(this.opened_image, 'caption', image.caption);
        }
    },

    mounted: function() {
        //
    }
});

export default Window.ITEM;