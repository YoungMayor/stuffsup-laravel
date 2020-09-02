export default {
    components: {
        // 'create-offer': CreateOffer
    },

    mixins: [
        //
    ],

    props: {
        notification: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            icon_mapping: {
                default: {
                    circle: 'bg-primary',
                    font: 'fas fa-file-alt'
                }
            }
        }
    },

    methods: {
        //
    },

    computed: {
        selected_icon: function() {
            return typeof(this.icon_mapping[this.notification.type]) == "undefined" ?
                this.icon_mapping.default :
                this.icon_mapping[this.notification.type];
        },

        notif_class_object: function() {
            let isNew = this.notification.new;
            return {
                'font-weight-bold bg-gradient-light': this.notification.new,
                '': !this.notification.new,
            }
        }
    },

    mounted: function() {
        //
    },

    template: `
<div
    class="d-flex align-items-center dropdown-item fa text-secondary"
    :class="notif_class_object">
    <div class="mr-3">
        <div class="icon-circle" :class="selected_icon.circle">
            <i class="text-white" :class="selected_icon.font"></i>
        </div>
    </div>
    <div>
        <span class="small text-gray-500">
            {{ notification.posted.date }} - {{ notification.posted.time }}
        </span>

        <p>
            {{ notification.notif }}
        </p>
    </div>
</div>
    `
};