export default function ({ store, redirect }) {
    // If the user is authenticated redirect
    if (store.state.auth) {
        return redirect('/admin/' + store.state.auth.id)
    }
}