import MediaCard from "../MediaCard.js";
import AxiosForm from "../AxiosForm.js";
import TextareaForm from "../TextareaForm.js";

export default {
    components: {
        'media-card': MediaCard,
        'axios-form': AxiosForm,
        'textarea-form': TextareaForm
    },

    mixins: [
        //
    ],

    props: {
        review: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            show_form: false
        }
    },

    methods: {
        switchForm: function(id) {
            this.show_form = this.show_form == id ? false : id;
        },

        deleteThis: function() {
            this.$emit('delete_review')
        }
    },

    computed: {
        parsed_details: function() {
            return {
                from: this.review.from,
                posted: this.review.posted,
                text: this.review.review
            }
        },
    },

    mounted: function() {
        //
    },

    template: `
<media-card
    :details="parsed_details"
>
    <span class="badge badge-pill badge-secondary float-right" slot="text">
        {{ review.rating }} <i class="fa fa-star p-1"></i>
    </span>

    <div slot="foot">
        <div class="text-center">
            <button
                class="btn btn-outline-info btn-sm m-1"
                v-if="review.edit"
                @click="switchForm('edit')"
                type="button">
                <span>
                    Edit
                </span>
                <i class="fas fa-pencil-alt p-1"></i>
            </button>

            <button
                class="btn btn-danger btn-sm m-1"
                v-if="review.delete"
                @click="switchForm('delete')"
                type="button">
                <span>
                    Delete
                </span>
                <i class="far fa-trash-alt p-1"></i>
            </button>
        </div>

        <textarea-form
            v-if="review.edit && show_form == 'edit'"
            :target="review.edit"
            heading="Edit your review"
            placeholder="Enter your review here"
            field="edit"
            submit="Save"
            v-model="review.review"
            data-dontreset="true"
        >
            <div>
                <input
                    type="number"
                    class="form-control form-control-sm d-inline w-auto rounded-pill mr-1"
                    name="rating"
                    :value="review.rating"
                    min="1.0"
                    max="5.0"
                    step="0.5"
                    required />
                <span>
                    star(s)
                </span>
            </div>
        </textarea-form>

        <axios-form
            v-if="review.delete && show_form == 'delete'"
            :action="review.delete"
            method="POST"
            loading="Deleting Review"
            :on_success="deleteThis"
            :add_submit="false">
            <div class="form-group text-center">
                <h6 class="text-danger">
                    <strong>
                        Your review on this user would be deleted
                    </strong>
                </h6>

                <button
                    class="btn btn-danger"
                    type="submit">
                    Yes, I understand
                </button>
            </div>
        </axios-form>
    </div>
</media-card>
    `
};