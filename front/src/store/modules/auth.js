import axios from 'axios';
const qs = require('qs');

const state = {
    isLogged: false
}

const mutations = {
    updateLogged(state, data) {
        state.isLogged = data;
    }
}

const actions = {
    login(context, data) {
        data = qs.stringify(data);
        return axios.post('/auth/token', data).then((res) => {
            window.axios.defaults.headers.common['Authorization'] = res.data.token;
            window.localStorage.setItem('token', res.data.token);
            context.commit('updateLogged', true);
            return res.data;
        })
    },
    logout(context) {
        window.localStorage.removeItem('token');
        context.commit('updateLogged', false);
    }
}

const namespaced = true;

export default {
    state,
    mutations,
    actions,
    namespaced
}
