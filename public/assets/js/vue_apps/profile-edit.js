import Vue from './vue_eb.full.js'

import AxiosForm from './components/AxiosForm.js';
import TextareaForm from './components/TextareaForm.js';
import ProtectedField from './components/ProtectedField.js';
import StateSelect from './components/StateSelect.js';
import StyledInput from './components/StyledInput.js';

Window.PROFILE_EDIT = new Vue({
    el: "#agent-profile-edit",

    mixins: [
        //
    ],

    components: {
        'axios-form': AxiosForm,
        'textarea-form': TextareaForm,
        'protected-field': ProtectedField,
        'state-select': StateSelect,
        'styled-input': StyledInput
    },

    data: {
        //
    },

    computed: {
        //
    },

    methods: {
        //
    },

    mounted: function() {
        //
    }
});

export default Window.PROFILE_EDIT;