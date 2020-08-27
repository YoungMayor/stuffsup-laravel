export default {
    props: {
        images: {
            type: Object,
            validator: function(elem) {
                return true
            },
            required: true
        },
        id: {
            type: String,
            default: 'images-carousel'
        },
        max_height: {
            type: String,
        },
        max_width: {
            type: String,
        },
    },

    data() {
        return {
            //
        }
    },

    methods: {
        addImage: function(link) {
            return {
                backgroundImage: `url('${link}')`
            }
        }
    },

    computed: {
        valid_images: function() {
            return this.images.filter(function(elem) {
                return typeof(elem.caption, elem.preview, elem.full) === "string";
            })
        },

        objectStyle: function() {
            return {
                maxHeight: this.max_height,
                maxWidth: this.max_width
            }
        }
    },

    mounted: function() {
        //
    },

    template: `
<div
    v-if="valid_images.length"
    data-ride="carousel"
    data-interval="false"
    class="carousel slide carousel-custom bg-gradient-light overflow-hidden"
    :style="objectStyle"
    :id="id">
    <div role="listbox" class="carousel-inner">
        <div
            v-for="image, index in valid_images"
            class="carousel-item"
            :class="index == '0' ? 'active' :  ''">
            <img
                class="d-block m-auto img-fluid"
                :src="image.full"
                alt="Slide Image"
                loading="lazy" />

            <div class="carousel-caption p-1 overflow-auto">
                <p class="text-nowrap mb-0">
                    {{ image.caption }}
                </p>
            </div>
        </div>
    </div>

    <div>
        <a
            :href="'#'+id"
            role="button"
            data-slide="prev"
            class="carousel-control-prev">
            <span aria-hidden="true" class="carousel-control-prev-icon"></span>
            <span class="sr-only">
                Previous
            </span>
        </a>

        <a
            :href="'#'+id"
            role="button"
            data-slide="next"
            class="carousel-control-next">
            <span aria-hidden="true" class="carousel-control-next-icon"></span>
            <span class="sr-only">
                Next
            </span>
        </a>
    </div>

    <ol class="carousel-indicators">
        <li
            v-for="image, index in valid_images"
            :data-target="'#'+id"
            :data-slide-to="index"
            :class="index == '0' ? 'active' :  ''"
            :style="addImage(image.preview)">
        </li>
    </ol>
</div>
    `
};