import Vue from './vue_eb.js'
import SalesCard from './components/Market/SalesCard.js';
import ContentLoader from './components/ContentLoader.js';

Window.MARKET = new Vue({
    el: "#market-sales",

    mixins: [
        //
    ],

    components: {
        'sales-card': SalesCard,
        'content-loader': ContentLoader
    },

    data: {
        market_items: {}
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

export default Window.MARKET;