export default function ({ store, redirect }) {
    // If the user is authenticated redirect
    if (store.state.auth) {
        console.log(store.state.auth.id)
        return redirect('/admin/' + store.state.auth.id)
    }
}