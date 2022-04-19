
import { isAuthorized } from './helpers'
import VueRouter from 'vue-router';

import Unauthorized from '../pages/Extras/Unauthorized.vue'
import NotFound from '../pages/Extras/NotFound.vue'

import AdminDashboard from '../pages/Admin/Dashboard.vue'
import AdminDashIndex from '../pages/Admin/Index.vue'
import AdminDashClient from '../pages/Admin/Client.vue'
import AdminDashWallet from '../pages/Admin/Wallet.vue'
import AdminDashCreateClient from '../pages/Admin/CreateClient.vue'


import AuthLogin from '../pages/Auth/Login.vue'
import AuthRegister from '../pages/Auth/Register.vue'
import AuthAdminLogin from '../pages/Auth/LoginAdmin.vue'
import AuthVerifyEmail from '../pages/Auth/VerifyEmail.vue'
import AuthEmailVerified from '../pages/Auth/VerifiedEmail.vue'
import Auth2FAllogin from '../pages/Auth/TwoFAllogin.vue'
import AuthChangePassword from '../pages/Auth/ChangePassword.vue'
import AuthBackupResetPassword from '../pages/Auth/BackupResetPassword.vue'


import ClientDashboard from '../pages/Client/Dashboard.vue'
import ClientDashIndex from '../pages/Client/Index.vue'
import ClientDashBtc from '../pages/Client/BTC.vue'
import ClientDashFiat from '../pages/Client/Fiat.vue'
import ClientSettings from '../pages/Client/Settings.vue'
import ClientActivities from '../pages/Client/Activities.vue'


const routes = [
    { path: '/login', component: AuthLogin },
    { path: '/register', component: AuthRegister },
    { path: '/login-admin', component: AuthAdminLogin },
    { path: '/2fa-login', component: Auth2FAllogin },
    { path: '/verify-email', component: AuthVerifyEmail },
    { path: '/change-password', component: AuthChangePassword },
    { path: '/email-verification', component: AuthEmailVerified },
    { path: '/backup-reset-password', component: AuthBackupResetPassword },

    {
        path: '/dashboard', component: ClientDashboard, beforeEnter(to, from, next) {
            return isAuthorized('client', next)
        }, children: [
            { path: '/', component: ClientDashIndex },
            { path: 'btc', component: ClientDashBtc },
            { path: 'settings', component: ClientSettings },
            { path: 'activities', component: ClientActivities },
            { path: ':id', component: ClientDashFiat },
        ]
    },
    {
        path: '/admin', component: AdminDashboard, beforeEnter(to, from, next) {
            return isAuthorized('admin', next)
        },
        children: [
            { path: '/', component: AdminDashIndex },
            { path: 'clients', component: AdminDashClient },
            { path: 'create_client', component: AdminDashCreateClient },
            { path: 'wallets', component: AdminDashWallet },
        ]
    },

    { path: '/unauthorized', component: Unauthorized },
    { path: '*', component: NotFound },
];

export const router = new VueRouter({
    routes,
    mode: 'history'
});