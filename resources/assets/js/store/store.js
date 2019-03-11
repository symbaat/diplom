import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        students: [],
        blank: {
            id: '',
            name: '',
            email: '',
            phone_number: ''
        }
    },
    mutations: {
        getStudentsList(state, students) {
            state.students = students;
        }
    }
});

export default store;