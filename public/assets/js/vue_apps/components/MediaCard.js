/**
 * @use
 * To use pass a required details object to it.
 * The details object should follow the following pattern
 *  details: {
 *      from: {
 *          avatar,
 *          link
 *          name
 *      },
 *      posted: {
 *          date,
 *          time
 *      },
 *      text,
 *      link: {
 *          target,
 *          label,
 *          icon
 *      } *optional
 * }
 */

export default {
    components: {
        // 'create-offer': CreateOffer
    },

    mixins: [
        //
    ],

    props: {
        details: {
            type: Object,
            required: true
        }
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
<div class="media p-1 mb-4" data-aos="fade-left" data-aos-duration="1000">
    <img
        class="rounded-circle img-fluid mr-1"
        :src="details.from.avatar"
        width="48px">

    <div class="media-body pl-2 border-left">
        <h5 class="font-weight-bold mb-1">
            <a
                class="text-decoration-none"
                :href="details.from.link"
                target="_blank">
                {{ details.from.name }}
            </a>
        </h5>

        <small>
            {{ details.posted.date }} - {{ details.posted.time }}
        </small>

        <p class="mb-1">
            {{ details.text }}

            <slot name="text"></slot>
        </p>

        <div v-if="details.link">
            <a
                class="btn btn-outline-info btn-sm"
                role="button"
                :href="details.link.target"
                target="_blank">
                <span>
                    {{ details.link.label }}
                </span>
                <i
                    class="p-1"
                    :class="details.link.icon"
                    v-if="details.link.icon"></i>
            </a>
        </div>

        <slot name="foot"></slot>
    </div>
</div>
    `
};