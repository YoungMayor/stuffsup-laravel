export default {
    props: {
        name: {
            type: String,
            default: 'category'
        },
        method: {
            type: String,
            default: 'select',
            validator: function(value) {
                return [
                    'select',
                    'buttons'
                ].indexOf(value) !== -1;
            }
        },
        label: {
            type: String,
            default: 'Select Category'
        }
    },

    data() {
        return {
            category_selections: [],
        }
    },

    methods: {
        categoryBack: function(ind) {
            this.category_selections.length = ind + 1;
            this.category_selections = this.category_selections.flat()
        },

        optionSelect: function(e) {
            let selected_field = e.target.selectedOptions[0];

            this.category_selections.push({
                id: selected_field.dataset.id,
                label: selected_field.dataset.label
            });
            e.target.selectedIndex = 0;
        },

        buttonSelect: function(key, name) {
            this.category_selections.push({
                id: key,
                label: name
            });
        },
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

        selected_id: function() {
            let res = "";
            this.category_selections.forEach(current => {
                res += current.id;
            });
            return res;
        }
    },

    mounted: function() {
        //
    },

    template: `
<div class="form-row py-3">
    <div class="col-12">
        <h6 class="text-center">
            <strong>
                {{ label }}
            </strong>
        </h6>
    </div>

    <div class="col-12">
        <ol class="breadcrumb">
            <li class="fa m-1">
                <a
                    @click.prevent="categoryBack(-1)"
                    class="fa fa-home"
                    href="#"></a>
            </li>
            <li
                v-for="(category, index) in category_selections"
                class="fa fa-chevron-right m-1">
                <a @click.prevent="categoryBack(index)">
                    <span>
                        {{ category.label }}
                    </span>
                </a>
            </li>
        </ol>
    </div>

    <div
        class="col-12"
        v-if="selection_is_final">
        <div class="alert alert-secondary" role="alert">
            <strong>
                {{ current_selection }}
            </strong>
        </div>

        <input type="hidden" :name="name" :value="selected_id">
    </div>

    <template v-else>
        <div
            class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto"
            v-if="method == 'select'">
            <select
                class="custom-select"
                @change="optionSelect"
                required="">
                <option label="Select Category" selected></option>

                <option
                    v-for="details, key in current_selection"
                    :value="key"
                    :data-id="key"
                    :data-label="details.name">
                    {{ details.name }}
                </option>
            </select>
        </div>

        <template v-if="method == 'buttons'">
            <input type="hidden" :name="name" :value="selected_id">

            <div
                class="col-6 col-sm-4 p-0"
                v-for="details, key in current_selection">

                <button
                    class="btn btn-outline-success btn-block d-flex flex-column justify-content-center align-items-center border-0 h-100 shadow-none"
                    @click="buttonSelect(key, details.name)"
                    type="button">
                    <i class="fas fa-question fa-2x"></i>
                    <span>
                        {{ details.name }}
                    </span>
                </button>
            </div>
        </template>
    </template>
</div>
    `
};