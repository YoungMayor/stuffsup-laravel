import Vue from './vue_eb.js'
import StyledInput from './components/StyledInput.js';
import __axios_form from './mixins/__axios_form.js';
import ImageCaption from './components/CreateSales/ImageCaption.js';

Window.CREATESALE = new Vue({
    el: "#create-sales-form",

    mixins: [
        __axios_form
    ],

    components: {
        'styled-input': StyledInput,
        'image-caption': ImageCaption
    },

    data: {
        category_selections: [],

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
        current_selection: function() {
            let selection = Window.Categories;

            if (this.category_selections.length < 1) {
                return selection
            }

            this.category_selections.forEach(current => {
                let sel_id = Number(current.id);

                if (selection.hasOwnProperty(sel_id)) {
                    selection = selection[sel_id];

                    if (selection.sub && typeof(selection.sub) == 'object') {
                        selection = selection.sub;
                    } else {
                        selection = selection.name;
                    }
                }
            });
            return selection;
        },

        selection_is_final: function() {
            return typeof(this.current_selection) == 'string';
        },

        final_selection: function() {
            return this.category_selections[this.category_selections.length - 1];
        }
    },

    methods: {
        categoryBack: function(ind) {
            this.category_selections.length = ind + 1;
            this.category_selections = this.category_selections.flat()
        },

        selectThis: function(e) {
            let selected_field = e.target.selectedOptions[0];
            this.category_selections.push({
                id: selected_field.dataset.id,
                label: selected_field.dataset.label
            });
            e.target.selectedIndex = 0;
        },

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