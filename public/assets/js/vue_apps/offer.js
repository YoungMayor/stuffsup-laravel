import Vue from './vue_eb.full.js'

import ContentLoader from './components/ContentLoader.js';
import PagePreload from './components/PagePreload.js';
import ElementTerminate from './components/ElementTerminate.js';
import ClosedSign from './components/ClosedSign.js';
import TextareaForm from './components/TextareaForm.js';
import RepliesCard from './components/Offers/RepliesCard.js';
import MediaCard from './components/MediaCard.js';
import ShowCard from './components/ShowCard.js';

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
        'replies-card': RepliesCard,
        'media-card': MediaCard,
        'show-card': ShowCard
    },

    data: {
        replies: {},
        page_details: {
            author: {
                link: '',
                name: '',
                avatar: ''
            },
            item: {
                title: '',
                link: '',
                desc: ''
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
        parsed_media_details: function() {
            return {
                from: this.page_details.author,
                posted: this.page_details.posted,
                text: this.page_details.offer
            };
        }
    },

    methods: {
        on_close: function() {
            window.location.reload();
        },

        deleteReply: function(key) {
            return this.$delete(this.replies, key);
        }
    },

    mounted: function() {
        //
    }
});

export default Window.OFFER;