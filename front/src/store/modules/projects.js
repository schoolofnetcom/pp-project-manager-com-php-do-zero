import _ from 'underscore';
import axios from 'axios';
const qs = require('qs');

const state = {
    all: []
}

const getters = {
    byId: state => (id) => {
        const data = _.find(state.all, (project) => {
            return project.id == id;
        });

        return data || {}
    }
}

const mutations = {
    updateAll(state, data) {
        state.all = data
    },
    merge(state, data) {
        state.all.push(data);
    }
}

const actions = {
    getAll(context) {
        return axios.get('/api/projects').then((res) => {
            context.commit('updateAll', res.data)
        })
    },

    create(context, data) {
        data = qs.stringify(data);
        return axios.post('/api/projects', data).then((res) => {
            context.commit('merge', res.data);
        });
    }
}

export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true
}
