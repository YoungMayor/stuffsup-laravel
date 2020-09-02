import Vue from './vue_eb.full.js'

import ContentLoader from './components/ContentLoader.js';
import NotificationCard from './components/TopBar/NotificationCard.js';

Window.NOTIFICATION_CENTER = new Vue({
    el: "#notification-center",

    mixins: [
        //
    ],

    components: {
        'content-loader': ContentLoader,
        'notification-card': NotificationCard
    },

    data: {
        notifications: {},
        notification_count: '+5',
        getting_count: false
    },

    computed: {
        //
    },

    methods: {
        getCount: function() {
            let bar = this;
            if (bar.getting_count) {
                return;
            }

            bar.getting_count = true;

            axios.post(bar.$el.dataset.countLink)
                .then(function(response) {
                    var data = response.data;

                    bar.notification_count = data;
                }).catch(function(error) {
                    if (!error.response && error.response.data) {
                        return false;
                    }
                    let data = error.response.data;
                    var message = "An error was encountered with your request";
                    var title = "Error!!!";

                    if (data.msg) {
                        message = data.msg;
                    }

                    if (data.title) {
                        title = data.title;
                    }

                    $.notify({
                        title: title + '<br/>',
                        message: "<div class='small'>" + message + "</div>",
                        icon: "fa fa-warning"
                    }, {
                        allow_dismiss: true,
                        type: 'danger',
                        delay: 3000
                    });
                }).finally(function() {
                    bar.getting_count = false;
                });
        }
    },

    mounted: function() {
        this.getCount();
    }
});

export default Window.NOTIFICATION_CENTER;