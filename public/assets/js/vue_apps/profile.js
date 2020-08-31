import Vue from './vue_eb.full.js'
import LinkCopy from './components/LinkCopy.js';
import SalesCard from './components/Market/SalesCard.js';
import ContentLoader from './components/ContentLoader.js';
import AxiosForm from './components/AxiosForm.js';

Window.OFFER = new Vue({
    el: "#agent-profile",

    mixins: [
        //
    ],

    components: {
        'link-copy': LinkCopy,
        'sales-card': SalesCard,
        'content-loader': ContentLoader,
        'axios-form': AxiosForm
    },

    data: {
        sales: {}
    },

    computed: {
        //
    },

    methods: {
        //
    },

    mounted: function() {
        //
    }
});

export default Window.OFFER;