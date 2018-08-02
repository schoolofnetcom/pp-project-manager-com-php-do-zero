import axios from 'axios';
import store from './store';

window.axios = axios;
const token = window.localStorage.getItem('token');

if (token) {
    window.axios.defaults.headers.common['Authorization'] = token;
    store.commit('auth/updateLogged', true);
}
