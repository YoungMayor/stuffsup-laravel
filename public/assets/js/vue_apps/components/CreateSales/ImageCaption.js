export default {
    mixins: [
        //
    ],

    props: {
        index: {
            default: function() {
                return 0;
            },
            type: Number
        }
    },

    data() {
        return {
            uploaded_image: '',
            image_size_in_bytes: 0,
            image_name: '',

            min: 128000,
            max: 1024000
        }
    },

    methods: {
        openImages: function() {
            this.$refs.image_input.click();
        },

        readImage: function() {
            var fileInput = this.$refs.image_input;
            this.image_error = "";

            if (fileInput.files && fileInput.files[0]) {
                var thisImage = fileInput.files[0];

                this.image_size_in_bytes = thisImage.size;
                this.image_name = thisImage.name;

                this.uploaded_image = window.URL.createObjectURL(thisImage)
            } else {
                this.uploaded_image = '';
                this.image_size_in_bytes = 0;
                this.image_name = '';
            }
        },

        resetImage: function() {
            this.$refs.image_input.value = "";
            this.readImage();
        },

        deleteImage: function() {
            this.$emit('delete_image')
        }
    },

    computed: {
        styleObject: function() {
            return {
                width: '90%',
                paddingBottom: '90%',
                margin: 'auto',
                backgroundSize: 'contain !important',
                backgroundRepeat: 'no-repeat',
                backgroundPosition: 'center center !important',
                backgroundImage: 'url("' + this.active_image + '")',
            }
        },

        previewMaxWidthStyle: function() {
            return {
                maxWidth: `240px`
            };
        },

        active_image: function() {
            return this.uploaded_image.length > 1 ? this.uploaded_image : this.initial_image;
        },

        image_size_valid: function() {
            let file_size = this.image_size_in_bytes;

            return file_size > this.min && file_size < this.max;
        },

        image_error: function() {
            let file_size = this.image_size_in_bytes;

            if (file_size === 0) {
                return "Image selection is required";
            } else if (file_size < this.min) {
                return "Image size too small minumum size is 128kb";
            } else if (file_size > this.max) {
                return "Image too large maximum size is 1mb";
            } else {
                return "";
            }
        },

        border_class: function() {
            return {
                'border-success': this.image_size_valid,
                'border-danger': !this.image_size_valid
            };
        },
    },

    mounted: function() {
        //
    },

    template: `
<div class="col shadow rounded-lg border my-2" :class="border_class">
    <div class="form-row my-3">
        <div class="col-12">
            <div class="form-group text-center">
                <div class="btn-group" role="group">
                    <button
                        class="btn btn-outline-success"
                        @click="openImages"
                        type="button">
                        <span>
                            Pick
                        </span>
                        <i class="fas fa-link p-1"></i>
                    </button>

                    <button
                        class="btn btn-outline-warning"
                        @click="resetImage"
                        type="button">
                        <span>Reset</span>
                        <i class="fa fa-refresh p-1"></i>
                    </button>

                    <button
                        class="btn btn-outline-danger"
                        @click="deleteImage"
                        type="button">
                        <span>Delete</span>
                        <i class="far fa-trash-alt p-1"></i>
                    </button>
                </div>
            </div>

            <div class="small text-center text-danger">
                {{ image_error }}
            </div>

            <div
                class="p-1 m-auto w-100"
                :style="previewMaxWidthStyle"
                v-show="active_image">

                <input
                    class="d-none"
                    type="file"
                    :id="'attachment['+index+'][image]'"
                    :name="'attachment['+index+'][image]'"
                    required="required"
                    accept="image/*"
                    @change="readImage"
                    ref="image_input" />

                <div class="preview_class" :style="styleObject"></div>
            </div>

            <div
                v-show="active_image"
                class="form-group text-center w-75 m-auto">
                <label>
                    Caption
                </label>
                <input
                    class="form-control"
                    type="text"
                    :id="'attachment['+index+'][caption]'"
                    :name="'attachment['+index+'][caption]'"
                    required="required"
                    placeholder="Caption for this image">
            </div>
        </div>
    </div>
</div>
    `
};