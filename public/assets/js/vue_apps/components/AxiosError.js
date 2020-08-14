export default {
    props: {
        errors: {
            required: true,
            type: Object
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
        errorBagCount: function() {
            return Object.entries(this.errors).length
        }
    },

    mounted: function() {
        //
    },

    template: `
<div
    v-if="errorBagCount > 0"
    role="alert"
    class="alert alert-danger px-0">
    <h5 class="alert-heading text-center font-weight-bold">
        <i class="fa fa-warning tada animated infinite fa-2x p-1"></i>
        <span class="d-inline-block swing animated">
            <strong>
                Processing Errors
            </strong>
        </span>
    </h5>

    <div
        v-for="error_bag, error_label in errors"
        class="p-1 border-bottom">
        <h6 class="mb-0 pb-3">
            <strong>"{{ error_label }}"</strong> field errors

            <label
                class="rounded-pill float-right btn btn-outline-secondary btn-sm"
                :for="error_label">
                <span>
                    Edit
                </span>
                <i class="far fa-edit p-1"></i>
            </label>
        </h6>

        <ul class="small">
            <li v-for="error in error_bag">
                {{ error }}
            </li>
        </ul>
    </div>
</div>
    `
};