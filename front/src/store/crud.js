import _ from 'underscore';
import axios from 'axios';
const qs = require('qs');

export default function (endpoit) {
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
        getAll(context, id) {
            let url = endpoit;
            if (id) {
                url += '?id=' + id;
            }

            return axios.get(url).then((res) => {
                context.commit('updateAll', res.data)
            })
        },

        create(context, data) {
            data = qs.stringify(data);
            return axios.post(endpoit, data).then((res) => {
                context.commit('merge', res.data);
            });
        }
    }

    return {
        state,
        actions,
        mutations,
        getters,
        namespaced: true
    }
}
