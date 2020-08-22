import __axios_form from "../mixins/__axios_form.js";

export default {
    mixins: [
        __axios_form
    ],

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
<form
    :action="target"
    method="POST"
    @submit.prevent="__submitAxiosForm"
    class="m-0">
    <div class="form-group px-1 py-2 m-0">
        <label
            class="small m-0 font-weight-bold"
            for="offer">
            {{ heading }}
        </label>

        <textarea
            class="form-control form-control-sm mb-2"
            name="offer"
            :placeholder="placeholder"
            rows="3"
            required=""></textarea>

        <button
            class="btn btn-success btn-sm ml-auto d-block"
            type="submit">
            Send
        </button>
    </div>
</form>
    `
};