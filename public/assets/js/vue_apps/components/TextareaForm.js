import AxiosForm from "./AxiosForm.js";

export default {
    mixins: [
        //
    ],

    model: {
        prop: 'value',
        event: 'input'
    },

    components: {
        'axios-form': AxiosForm
    },

    props: {
        target: {
            type: String,
            required: true
        },
        heading: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            required: true
        },
        field: {
            type: String,
            required: true
        },
        submit: {
            type: String,
            default: 'Send'
        },
        value: {
            type: String,
            default: ''
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
<axios-form
    :action="target"
    method="POST"
    :add_submit="false"
    class="m-0">
    <div class="form-group px-1 py-2 m-0">
        <label
            class="small m-0 font-weight-bold"
            for="offer">
            {{ heading }}
        </label>

        <textarea
            class="form-control form-control-sm mb-2"
            :name="field"
            :placeholder="placeholder"
            rows="3"
            :value="value"
            @input="$emit('input', $event.target.value)"
            required=""></textarea>

        <button
            class="btn btn-success btn-sm ml-auto d-block"
            type="submit">
            {{ submit }}
        </button>
    </div>
</axios-form>
    `
};