/**
 * Slots
 *  Unlocker
 *  Field
 */

export default {
    props: {
        custom_unlocker: {
            type: Boolean,
            default: false
        },
        unlock_button: {
            type: String,
            default: 'Confirm'
        },
        unlock_action: {
            type: String,
            default: 'open'
        },
    },

    data() {
        return {
            lock: true,
            generated_token: Math.random().toString(20).substr(2, 4).toLocaleUpperCase(),
            typed_token: '',
        }
    },

    methods: {
        //
    },

    computed: {
        //
    },

    mounted: function() {
        //
    },

    template: `
<div>
    <div class="form-row" v-if="lock">
        <div class="col">
            <div class="form-group">
                <label class="d-block text-center">
                    Enter <strong>{{ generated_token }}</strong> to {{  unlock_action }}
                </label>

                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        :placeholder="generated_token"
                        v-model="typed_token" />

                    <div class="input-group-append" v-if="typed_token == generated_token">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            @click="lock = false">
                            {{ unlock_button }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template v-else>
        <slot></slot>
    </template>
</div>
    `
};