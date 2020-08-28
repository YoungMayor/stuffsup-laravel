import AxiosError from "./AxiosError.js";

export default {
    components: {
        'axios-error': AxiosError
    },

    mixins: [
        //
    ],

    props: {
        action: {
            type: String,
            default: location.href
        },
        method: {
            type: String,
            default: 'POST'
        },
        loading: {
            type: String,
            default: 'Processing Form'
        },
        submit: {
            type: String,
            default: 'Save'
        },
        add_submit: {
            type: Boolean,
            default: true
        },
        on_success: {
            type: Function
        }
    },

    data() {
        return {
            form: null,
            data: null,
            validate_errors: {}
        }
    },

    methods: {
        submitAxiosForm() {
            var bar = this;

            bar.data = new FormData(bar.form);

            bar.beforeSubmit();

            axios({
                method: bar.method,
                url: bar.action,
                data: bar.data
            }).then(function(response) {
                var data = response.data;

                bar.alertSuccess(data);
                if (typeof(bar.on_success) == 'function') {
                    bar.on_success(data);
                }
                if (!bar.form.dataset.dontreset) {
                    bar.form.reset();
                }
            }).catch(function(error) {
                if (!error.response) {
                    // console.log(error)
                    return;
                }
                let error_status = error.response.status;
                let error_data = error.response.data;

                switch (error_status) {
                    case 422:
                    case "422":
                        bar.error422(error_data)
                        break;

                    default:
                        bar.alertError(error_data);
                        break;
                }
            }).finally(function() {
                bar.toogleDisable(false);
            });
        },

        beforeSubmit() {
            var bar = this;

            $.notify({
                title: `${bar.loading} <br/>`,
                message: "<div class='small'>Please wait...</div>",
                icon: "fa fa-spin fa-spinner"
            }, {
                allow_dismiss: true,
                type: 'info',
                delay: 2000
            });

            for (const bag in bar.validate_errors) {
                bar.$delete(bar.validate_errors, bag);
            }

            for (const key in bar.form.elements) {
                if (bar.form.elements.hasOwnProperty(key)) {
                    const element = bar.form.elements[key];
                    element.classList.remove('border-danger', 'shake', 'animated')
                }
            }

            bar.toogleDisable(true);
        },

        toogleDisable: function(state) {
            for (const key in this.form.elements) {
                if (this.form.elements.hasOwnProperty(key)) {
                    const form_field = this.form.elements[key];
                    form_field.disabled = state;
                }
            }
        },

        alertSuccess(data) {
            var message = "Form was submitted successfully";
            var title = "Success";

            if (data.msg) {
                message = data.msg;
            }

            if (data.title) {
                title = data.msg;
            }

            $.notify({
                title: title + '<br/>',
                message: "<div class='small'>" + message + "</div>",
                icon: "fa fa-check"
            }, {
                allow_dismiss: true,
                type: 'success',
                delay: 3000
            });
        },

        error422(data) {
            let bar = this;

            if (data.errors && bar.validate_errors) {
                for (const error_bag in data.errors) {
                    if (!bar.validate_errors.hasOwnProperty(error_bag)) {
                        bar.$set(bar.validate_errors, error_bag, [])
                    }

                    bar.validate_errors[error_bag] = data.errors[error_bag];

                    if (typeof(bar.form.elements[error_bag]) == "object") {
                        bar.form.elements[error_bag].classList.remove('border-0')
                        bar.form.elements[error_bag].classList.add('border-danger', 'border', 'shake', 'animated')
                    }
                }
            }
        },

        alertError(data) {
            var message = "An error was encountered with your request";
            var title = "Error!!!";

            if (data.msg) {
                message = data.msg;
            }

            if (data.title) {
                title = data.msg;
            }

            $.notify({
                title: title + '<br/>',
                message: "<div class='small'>" + message + "</div>",
                icon: "fa fa-warning"
            }, {
                allow_dismiss: true,
                type: 'danger',
                delay: 3000
            });
        },
    },

    computed: {
        //
    },

    mounted: function() {
        this.form = this.$refs.form;
    },

    template: `
<form
    :action="action"
    :method="method"
    ref="form"
    @submit.prevent="submitAxiosForm">

    <slot></slot>

    <axios-error
        class="my-2"
        :errors="validate_errors"
    ></axios-error>

    <div class="form-group text-right mt-3" v-if="add_submit">
        <button class="btn btn-primary" type="submit">
            {{ submit }}
        </button>
    </div>
</form>
    `
};