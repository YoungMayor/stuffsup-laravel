export default {
    mixins: [
        //
    ],

    props: {
        content: {
            type: Object,
            default: function() {
                return {};
            }
        },
        target: {
            type: String,
            default: location.href
        },
        loading: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            page_loaded: false,
        }
    },

    methods: {
        retrieve: function() {
            let bar = this;
            bar.page_loaded = false;

            axios.post(bar.target)
                .then(function(response) {
                    var data = response.data;

                    if (data.data) {
                        for (const key in data.data) {
                            if (data.data.hasOwnProperty(key)) {
                                const element = data.data[key];
                                bar.$set(bar.content, key, element);
                            }
                        }
                    }
                    bar.page_loaded = true;
                }).finally(function() {
                    //
                });
        }
    },

    computed: {
        //
    },

    mounted: function() {
        this.retrieve()
    },

    template: `
<div>
    <slot v-if="page_loaded"></slot>

    <div
        v-else
        class="bg-white d-flex flex-column justify-content-center align-items-center"
        id="preloader">

        <div class="text-center loader mb-5">
            <h4 class="fa fa-2x">
                Loading...
            </h4>
        </div>

        <span>
            {{ loading }}
        </span>
    </div>
</div>
    `
};