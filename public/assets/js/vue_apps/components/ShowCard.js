export default {
    props: {
        border: {
            type: String,
            default: 'success',
            validate: function(value) {
                return [
                    'success',
                    'secondary'
                ].indexOf(value) !== -1;
            }
        },

        label: {
            type: String
        },

        content: {
            type: String
        },

        icon: {
            type: String
        },

        aos: {
            type: String,
            default: 'fade-right'
        },

        duration: {
            type: String,
            default: '500'
        },
    },

    data() {
        return {
            //
        }
    },

    methods: {
        //
    },

    computed: {
        border_class: function() {
            return `border-left-${this.border}`;
        }
    },

    mounted: function() {
        //
    },

    template: `
<div class="card shadow py-2 overflow-hidden" :class="border_class">
    <div class="card-body" :data-aos="aos" :data-aos-duration="duration">
        <div class="row justify-content-center align-items-center no-gutters">
            <div class="col mr-2">
                <div
                    v-if="label"
                    class="text-uppercase text-success font-weight-bold text-xs mb-1">
                    <span>
                        {{ label }}
                    </span>
                </div>

                <div
                    v-if="content"
                    class="text-dark font-weight-bold h5 mb-0">
                    <span>
                        {{ content }}
                    </span>
                </div>

                <div>
                    <slot></slot>
                </div>
            </div>

            <div v-if="icon" class="col-auto">
                <i class="fa-2x text-gray-300" :class="icon"></i>
            </div>
        </div>
    </div>
</div>
    `
};