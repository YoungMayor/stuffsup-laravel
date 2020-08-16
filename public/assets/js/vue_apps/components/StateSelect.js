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
        <option value="0">
            Nationwide
        </option>
        <optgroup label="Select State">
            <option
                v-for="details, key in Window.States"
                :value="key">
                {{ details.name }}
            </option>
        </optgroup>
    </select>
</div>
    `
};