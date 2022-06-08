import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export const store = new Vuex.Store({
    plugins: [createPersistedState({ storage: window.localStorage })],
    state: {
        verification_email: "",
        logged_in_user: {},
        back_up_token: {},
        open_drawal: false,
        draw_status: 'send',
        draw_payload: null,
        current_client: null
    },
    getters: {
        getVerificationEmail: (state) => {
            return state.verification_email
        },
        getBackupToken: (state) => {
            return state.back_up_token
        },
        getDrawalStatus: (state) => {
            return state.open_drawal
        },
        getCurrentPage: (state) => {
            return state.draw_status
        },
        getDrawPayload: (state) => {
            return state.draw_payload
        },
        getClientDetail: (state) => {
            return state.current_client
        },
        getLoggedInUser: (state) => {
            return state.logged_in_user
        }

    },
    mutations: {
        setVerificationEmail: (state, email) => {
            state.verification_email = email
        },
        setLoggedInUser: (state, user) => {
            state.logged_in_user = user
        },
        setBackupToken: (state, data) => {
            state.back_up_token = data
        },
        setAdjustDrawal: (state, data) => {
            state.open_drawal = data
        },
        setCurrentDraw: (state, data) => {
            return state.draw_status = data
        },
        setCurrentDrawPayload: (state, data) => {
            return state.draw_payload = data
        },
        setClientDetail: (state, data) => {
            return state.current_client = data
        }
    },
    actions: {
        verificationEmail: ({ commit }, email) => {
            commit('setVerificationEmail', email)
        },
        loggedInUser: ({ commit }, user) => {
            commit('setLoggedInUser', user)
        },
        backupToken: ({ commit }, data) => {
            commit('setBackupToken', data)
        },
        closeDraw: ({ commit }) => {
            commit('setAdjustDrawal', false)
        },
        sendBitcoin: ({ commit }, data) => {
            commit('setCurrentDraw', 'send')
            commit('setAdjustDrawal', data)
        },
        recieveBitcoin: ({ commit }, data) => {
            commit('setCurrentDraw', 'recieve')
            commit('setAdjustDrawal', data)
        },
        transferBitcoin: ({ commit }, data) => {
            commit('setAdjustDrawal', data)
        },
        adjustDrawal: ({ commit }, page) => {
            commit('setCurrentDraw', page)
            commit('setAdjustDrawal', true)
        },
        adjustDrawalPayload: ({ commit }, page) => {
            commit('setCurrentDraw', page.draw)
            commit('setCurrentDrawPayload', page.payload)
            commit('setAdjustDrawal', true)
        },
        loggedInClientDetail: async ({ commit }) => {
            const data = await axios.get("/api/client/wallet_balance/bitcoin")
            if (data) {
                commit('setClientDetail', data.data)
            }
        }
    }
})