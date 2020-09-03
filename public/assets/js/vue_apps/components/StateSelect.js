export default {
    props: {
        name: {
            type: String,
            default: 'state'
        },
        input_class: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: 'State'
        },
        required: {
            type: Boolean,
            default: true
        },
        with_nation: {
            type: Boolean,
            default: true
        },
        value: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            all_states: Window.States
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
<div class="form-group text-white bg-secondary d-flex align-items-center rounded-pill border">
    <label class="text-nowrap my-0 mx-1" :for="name">
        {{ label }}
    </label>

    <select
        class="custom-select rounded-pill shadow-none border-0 bg-white"
        :class="input_class"
        :id="name"
        :name="name"
        :required="required">
        <option value="0" v-if="with_nation">
            Nationwide
        </option>
        <optgroup label="Select State">
            <option
                v-for="details, key in all_states"
                :value="key"
                :selected="key == value">
                {{ details.name }}
            </option>
        </optgroup>
    </select>
</div>
    `
};