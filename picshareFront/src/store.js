import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        status: '',
        userToken: localStorage.getItem('userToken') || '',
        userID: localStorage.getItem('userID') || '',
    },
    getters : {
        getLoggedUserID: state => state.userID,
    },
    mutations: {
        auth_success(state, user) {
            localStorage.setItem('userID', user.user.id)
            localStorage.setItem('userToken', user.user.token)
            state.status = 'success'
            state.userID = user.user.id
            state.userToken = user.user.token
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout() {
            localStorage.setItem('userID', '')
            localStorage.setItem('userToken', '')
        }
    },
    actions: {
        login({commit},user) {
            commit('auth_success', user)
        },
        logout({commit}) {
            commit('logout')
            window.location.href = '/'
        }
    }
})