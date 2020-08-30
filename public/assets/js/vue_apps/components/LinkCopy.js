export default {
    components: {
        // 'create-offer': CreateOffer
    },

    mixins: [
        //
    ],

    props: {
        link: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            //
        }
    },

    methods: {
        copyLink() {
            this.$refs.link.select();
            document.execCommand('copy', true);
            $.notify({
                title: 'Text Copied <br />',
                icon: 'fa fa-copy',
                message: 'Link has been copied to the clipboard'
            }, {
                allow_dismiss: true,
                type: 'info',
                delay: 1500,
            });
        }
    },

    computed: {
        //
    },

    mounted: function() {
        //
    },

    template: `
<div class="input-group input-group-sm">
    <input
        type="text"
        class="form-control"
        name="profile_link"
        :value="link"
        ref="link"
        readonly />

    <div class="input-group-append">
        <button
            class="btn btn-outline-secondary"
            @click="copyLink"
            type="button">
            <span
                class="d-none d-sm-inline">
                Copy
            </span>
            <i class="fas fa-copy p-1"></i>
        </button>
    </div>
</div>
    `
};