export default {
    props: {
        name: {
            required: true,
            type: String
        },
        type: {
            type: String,
            default: 'text'
        },
        pattern: {
            type: [String, Object]
        },
        input_class: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: 'Label'
        },
        required: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: ''
        },
        min: {
            type: Number,
        },
        max: {
            type: Number,
        },
        step: {
            type: Number,
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

    <input
        class="form-control rounded-pill border-0 shadow-none bg-white"
        :class="input_class"
        :type="type"
        :id="name"
        :name="name"
        :placeholder="placeholder"
        :required="required"
        :min="min"
        :max="max"
        :step="step"
        :pattern="pattern">
</div>
    `
};