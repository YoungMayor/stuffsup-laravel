import Vue from './vue_eb.js'
import StyledInput from './components/StyledInput.js';
import __axios_form from './mixins/__axios_form.js';
import ImageCaption from './components/CreateSales/ImageCaption.js';
import StateSelect from './components/StateSelect.js';
import CategorySelect from './components/CategorySelect.js';
import AxiosForm from './components/AxiosForm.js';

Window.CREATESALE = new Vue({
    el: "#create-sales-form",

    mixins: [
        __axios_form
    ],

    components: {
        'styled-input': StyledInput,
        'image-caption': ImageCaption,
        'state-select': StateSelect,
        'category-select': CategorySelect,
        'axios-form': AxiosForm
    },

    data: {
        locations: [
            'default'
        ],
        locations_index: 0,

        images: [
            'default'
        ],
        images_index: 0
    },

    computed: {
        //
    },

    methods: {
        addLocation: function() {
            let location_index = 'location_' + this.locations_index;
            this.locations_index += 1;
            this.locations.push(location_index);
        },

        removeLocation: function(key) {
            if (this.locations.length < 2) {
                return;
            }
            delete this.locations[this.locations.indexOf(key)];
            this.locations = this.locations.flat();
        },

        addImage: function() {
            let image_index = 'image_' + this.images_index;
            this.images_index += 1;
            this.images.push(image_index);
        },

        removeImage: function(key) {
            if (this.images.length < 2) {
                return;
            }
            delete this.images[this.images.indexOf(key)];
            this.images = this.images.flat();
        },
    },

    mounted: function() {
        //
    }
});

export default Window.CREATESALE;