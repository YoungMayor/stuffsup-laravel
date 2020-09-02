export default {
    mixins: [
        //
    ],

    props: {
        list: {
            type: Object,
            default: function() {
                return [];
            }
        },
        label: {
            type: String,
            default: 'Load More'
        },
        target: {
            type: String,
            default: location.href
        },
        icon: {
            type: String,
            default: null
        },
        show_button: {
            type: Boolean,
            default: true
        }
    },

    data() {
        return {
            item_count: 1,
            is_loading: false,
            list_ended: false,
            content_link: ''
        }
    },

    methods: {
        retrieve: function() {
            let bar = this;
            bar.is_loading = true;
            if (bar.list_ended) {
                return;
            }

            axios.post(bar.content_link)
                .then(function(response) {
                    var data = response.data;

                    if (data.links && data.links.next) {
                        bar.content_link = data.links.next;
                    } else {
                        bar.list_ended = true;
                    }

                    for (const key in data.data) {
                        if (data.data.hasOwnProperty(key)) {
                            const element = data.data[key];
                            bar.$set(bar.list, `item_${bar.item_count}`, element);
                            bar.item_count++;
                        }
                    }
                }).finally(function() {
                    bar.is_loading = false;
                });
        }
    },

    computed: {
        button_class: function() {
            return {
                'btn-outline-danger': this.list_ended,
                'btn-secondary': !this.list_ended,
            }
        }
    },

    mounted: function() {
        this.content_link = this.target;
        this.retrieve()
    },

    template: `
<div class="col-12 text-center p-2" v-if="show_button">
    <button
        class="btn rounded-pill shadow-sm"
        :class="button_class"
        data-aos="fade-right"
        data-aos-duration="1000"
        @click="retrieve"
        :disabled="is_loading || list_ended"
        type="button">
        <template v-if="list_ended">
            <span>
                No more result
            </span>
            <i class="fas fa-exclamation-circle p-1"></i>
        </template>

        <template v-else>
            <template v-if="is_loading">
                <span>
                    please wait...
                </span>
                <span
                    class="spinner-border spinner-border-sm"
                    role="status">
                </span>
            </template>

            <template v-else>
                <span>
                    {{  label  }}
                </span>
                <i class="p-1" :class="icon" v-if="icon"></i>
            </template>
        </template>
    </button>
</div>
    `
};