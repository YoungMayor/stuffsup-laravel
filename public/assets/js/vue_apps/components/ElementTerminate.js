import AxiosForm from "./AxiosForm.js";

export default {
    mixins: [
        //
    ],

    components: {
        'axios-form': AxiosForm
    },

    props: {
        element: {
            type: String,
            required: true
        },
        target: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Enter your reason for closing this'
        },
        success: {
            type: Function
        }
    },

    data() {
        return {
            show_form: false,
            generated_token: Math.random().toString(20).substr(2, 4).toLocaleUpperCase(),
            typed_token: ''
        }
    },

    methods: {
        //
    },

    computed: {
        valid_token: function() {
            return this.generated_token == this.typed_token;
        }
    },

    mounted: function() {
        //
    },

    template: `
<div>
    <div class="alert alert-danger" v-if="show_form">
        <axios-form
            :action="target"
            method="POST"
            :add_submit="false"
            :on_success="success">
            <div class="form-group">
                <label>
                    Reason For Close
                </label>

                <small class="float-right">
                    Reason not disclosed to other users
                </small>

                <textarea
                    class="form-control"
                    name="reason"
                    :placeholder="placeholder"
                    required></textarea>
            </div>

            <div class="form-group mb-0">
                <h6 class="mb-0">
                    Are you sure?
                </h6>

                <label>
                    Enter <strong>{{ generated_token }}</strong> below to confirm
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Enter the token above"
                    required
                    :pattern="generated_token"
                    v-model="typed_token"
                    minlength="4"
                    maxlength="4" />
            </div>

            <div class="form-group text-right">
                <button
                    @click="show_form = false"
                    class="btn btn-outline-info btn-sm m-1"
                    type="button">
                    No, Cancel Operation
                </button>

                <button
                    class="btn btn-danger btn-sm m-1"
                    :disabled="!valid_token"
                    v-if="valid_token"
                    type="submit">
                    Yes, Close {{ element }}
                </button>
            </div>
        </axios-form>
    </div>

    <div class="text-center alert-danger alert" v-else>
        <button
            class="btn btn-danger btn-block w-50 m-auto"
            @click="show_form = true"
            type="button">
            Close {{ element }}
        </button>

        <small class="form-text text-muted">
            This cannot be undone
        </small>
    </div>
</div>
    `
};