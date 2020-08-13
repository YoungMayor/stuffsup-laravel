// import axiosFormWithValidatorErrors from "../components/general/axios-form-with-validator-errors.js";

export default {
    components: {
        // 'error-bag': axiosFormWithValidatorErrors
    },

    methods: {
        __submitAxiosForm() {
            var bar = this;

            var formElement = event.target;

            var form_data = new FormData(formElement);

            var form_action = typeof(formElement.action) == "undefined" ? '/error' : formElement.action;

            var form_method = typeof(formElement.method) == "undefined" ? '/get' : formElement.method;

            bar.defaultBefore(formElement);

            axios({
                method: form_method,
                url: form_action,
                data: form_data
            }).then(function(response) {
                var data = response.data;

                bar.defaultSuccess(data);
                if (!formElement.dataset.dontreset) {
                    formElement.reset();
                }
            }).catch(function(error) {
                let error_status = error.response.status;
                let error_data = error.response.data;

                switch (error_status) {
                    case 422:
                    case "422":
                        bar.error422(error_data)
                        break;

                    default:
                        bar.defaultError(error_data);
                        break;
                }
            }).finally(function() {
                if (formElement.dataset.loader && formElement.dataset.loader.length > 1) {
                    bar[formElement.dataset.loader] = false;
                }
            });
        },

        defaultBefore(formElement) {
            var bar = this;

            $.notify({
                title: 'Processing Form <br/>',
                message: "<div class='small'>Please wait...</div>",
                icon: "fa fa-spin fa-spinner"
            }, {
                allow_dismiss: true,
                type: 'info',
                delay: 2000
            });

            if (formElement.dataset.loader && formElement.dataset.loader.length > 1) {
                bar[formElement.dataset.loader] = true;
            }

            if (typeof(bar.validate_errors) == "object") {
                for (const bag in bar.validate_errors) {
                    /* if (bar.validate_errors.hasOwnProperty(bag)) {
                        const element = bar.validate_errors[bag];
                        //
                    } */
                    bar.validate_errors[bag] = [];
                }
            }
        },

        defaultSuccess(data) {
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

        defaultError(data) {
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

        error422(data) {
            let bar = this;

            if (data.errors && bar.validate_errors) {
                for (const error_bag in data.errors) {
                    if (bar.validate_errors.hasOwnProperty(error_bag)) {
                        bar.validate_errors[error_bag] = data.errors[error_bag]
                    }
                }
            }
        }
    }
}