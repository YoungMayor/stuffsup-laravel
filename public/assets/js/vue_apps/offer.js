import Vue from './vue_eb.js'

import ContentLoader from './components/ContentLoader.js';
import PagePreload from './components/PagePreload.js';
import ElementTerminate from './components/ElementTerminate.js';
import ClosedSign from './components/ClosedSign.js';
import TextareaForm from './components/TextareaForm.js';
import RepliesCard from './components/Offers/RepliesCard.js';

Window.OFFER = new Vue({
    el: "#sales-offer",

    mixins: [
        //
    ],

    components: {
        'content-loader': ContentLoader,
        'page-preload': PagePreload,
        'element-terminate': ElementTerminate,
        'closed-sign': ClosedSign,
        'textarea-form': TextareaForm,
        'replies-card': RepliesCard
    },

    data: {
        replies: {},
        page_details: {
            author: {
                link: '',
                name: '',
                avatar: ''
            },
            title: '',
            item: {
                title: '',
                link: ''
            },
            posted: {
                date: '',
                time: ''
            },
            offer: '',
            closed: false,
            new_reply: '',
            get_replies: '',
            terminate: false,
            terminated: false
        }
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