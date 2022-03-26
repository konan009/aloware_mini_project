import Vuex from 'vuex';
import Vue from 'vue';
import states from './modules/states';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
  modules: {
    states
  }
});