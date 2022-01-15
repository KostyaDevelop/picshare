import VueRouter from 'vue-router'

import store from './store'
// import StartPage from './components/pages/StartPage'
import Login from './components/pages/Login'
import Register from './components/pages/Register'
import UserPage from './components/pages/UserPage'
import Posts from "./components/pages/Posts";
import Subscribers from "./components/pages/Subscribers";
import Subscriptions from "./components/pages/Subscriptions";
import People from './components/pages/People'
import pageNotFound from './components/pages/404'
// import Login from "./components/pages/Login";

export default  new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register,
        },
        {
            path: '/',
            component: function () {
                // console.log(store.getters.getLoggedUserID)
                if (store.getters.getLoggedUserID) {
                    window.location.href = '/user' + store.getters.getLoggedUserID
                } else {
                    return import('./components/pages/StartPage')
                }
            }
        },
        {
            path: '/user:id',
            component: UserPage,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/people',
            component: People
        },
        {
            path: '/user:id/subscribers',
            component: Subscribers,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/user:id/subscriptions',
            component: Subscriptions,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/user:id/posts',
            component: Posts,
            meta: {
                requiresAuth: true
            }
        },
       {
            path: '*',
            name: '404',
            component: pageNotFound,
        }
    ]
})