export default {
    props: {
        note: {
            required: true,
            type: String
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
<div class="text-center">
    <div class="bg-danger border rounded border-danger d-inline-block p-1 rounded-pill rotate-n-15 my-5">
        <h1
            class="display-4 text-white p-2 font-weight-bold m-0 rounded-pill bg-gradient-danger">
            {{ note }}
        </h1>
    </div>
</div>
    `
};