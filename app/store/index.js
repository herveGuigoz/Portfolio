const cookieparser = process.server ? require('cookieparser') : undefined

export const state = () => {
    return {
        auth: null
    }
}
export const mutations = {
    setAuth (state, auth) {
        state.auth = auth
    }
}
export const actions = {
    nuxtServerInit ({ commit }, { req }) {
        let auth = null
        if (req.headers.cookie) {
            try {
                auth = cookieparser.parse(req.headers.cookie)
                return commit('setAuth', {id: auth.id, token: auth.auth})
            } catch (err) {
                // No valid cookie found
            }
        }
        commit('setAuth', auth)
    }
}
export const getters =  {
    getUser: (state) => {
        return state.auth.id
    },
    getToken: (state) => {
        return state.auth.token
    }
};
