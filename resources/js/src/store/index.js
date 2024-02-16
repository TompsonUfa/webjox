import { createStore } from "vuex"
import auth from "@/store/modules/Auth.js";
import createPersistedState from 'vuex-persistedstate';

const store = createStore({
    plugins:[
        createPersistedState({paths: ['auth']})
    ],
    modules: {
        auth
    }
})

export default store;
