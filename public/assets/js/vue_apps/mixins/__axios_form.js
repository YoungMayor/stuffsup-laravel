import AxiosError from "../components/AxiosError.js";

export default {
    components: {
        'axios-error': AxiosError
    },

    data: function() {
        return {
            validate_errors: {}
        }
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
                        bar.error422(error_data, formElement)
                        break;

                    default:
                        bar.defaultError(error_data);
                        break;
                }
            }).finally(function() {
                bar.toogleDisable(formElement, false);
            });
        },

        defaultBefore(formObject) {
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

            if (typeof(bar.validate_errors) == "object") {
                for (const bag in bar.validate_errors) {
                    bar.$delete(bar.validate_errors, bag);
                }
            }

            for (const key in formObject.elements) {
                if (formObject.elements.hasOwnProperty(key)) {
                    const element = formObject.elements[key];
                    element.classList.remove('border-danger', 'shake', 'animated')
                }
            }

            bar.toogleDisable(formObject, true);
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

        toogleDisable: function(formObject, state) {
            let form_elements = formObject.elements;

            for (const key in form_elements) {
                if (form_elements.hasOwnProperty(key)) {
                    const form_field = form_elements[key];
                    form_field.disabled = state;
                }
            }
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

        error422(data, formObject) {
            let bar = this;

            if (data.errors && bar.validate_errors) {
                for (const error_bag in data.errors) {
                    if (!bar.validate_errors.hasOwnProperty(error_bag)) {
                        bar.$set(bar.validate_errors, error_bag, [])
                    }

                    bar.validate_errors[error_bag] = data.errors[error_bag];
                    formObject.elements[error_bag].classList.remove('border-0')
                    formObject.elements[error_bag].classList.add('border-danger', 'border', 'shake', 'animated')
                }
            }
        }
    }
}