import Vue from './vue_eb.js'
import StyledInput from './components/StyledInput.js';
import StateSelect from './components/StateSelect.js';
import CategorySelect from './components/CategorySelect.js';

Window.FILTERSALE = new Vue({
    el: "#filter-market-item",

    mixins: [
        // __axios_form
    ],

    components: {
        'styled-input': StyledInput,
        'state-select': StateSelect,
        'category-select': CategorySelect
    },

    data: {
        //
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

export default Window.FILTERSALE;