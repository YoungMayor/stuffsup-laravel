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
        reply: {
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
            this.$emit('delete_reply')
        }
    },

    computed: {
        parsed_details: function() {
            return {
                from: this.reply.from,
                posted: this.reply.posted,
                text: this.reply.reply
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
    <div slot="foot">
        <div class="text-center">
            <button
                class="btn btn-outline-info btn-sm m-1"
                v-if="reply.edit"
                @click="switchForm('edit')"
                type="button">
                <span>
                    Edit
                </span>
                <i class="fas fa-pencil-alt p-1"></i>
            </button>

            <button
                class="btn btn-danger btn-sm m-1"
                v-if="reply.delete"
                @click="switchForm('delete')"
                type="button">
                <span>
                    Delete
                </span>
                <i class="far fa-trash-alt p-1"></i>
            </button>
        </div>

        <textarea-form
            v-if="reply.edit && show_form == 'edit'"
            :target="reply.edit"
            heading="Edit your reply"
            placeholder="Enter your reply here"
            field="edit"
            submit="Save"
            v-model="reply.reply"
            data-dontreset="true"
        ></textarea-form>

        <axios-form
            v-if="reply.delete && show_form == 'delete'"
            :action="reply.delete"
            method="POST"
            loading="Deleting Reply"
            :on_success="deleteThis"
            :add_submit="false">
            <div class="form-group text-center">
                <h6 class="text-danger">
                    <strong>
                        Your reply would be deleted
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