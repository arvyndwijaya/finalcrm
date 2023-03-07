import { sendRequest } from '../utils/request'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import("../views/Customers/Index.vue"),
        },
        {
            path: '/customers',
            component: () => import("../views/Customers/Index.vue"),
        },
        {
            path: '/customers/create',
            component: () => import("../views/Customers/Create.vue"),
        },
        {
            path: '/customers/:id/edit',
            component: () => import("../views/Customers/Edit.vue"),
        },
        {
            path: '/customer-receipts',
            component: () => import("../views/CustomerReceipts/Index.vue"),
        },
        {
            path: '/materials',
            component: () => import("../views/Materials/Index.vue"),
        },
        {
            path: '/sales-order',
            component: () => import("../views/SalesOrder/Index.vue"),
        },
        {
            path: '/sales-order/:id',
            component: () => import("../views/SalesOrder/Show.vue"),
        },
    ],
})

router.beforeEach((to, from) => {
    const token = localStorage.getItem('token')
    if (!token) {
        if (!from.path !== '/') return "/"
    }

    sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/auth/verify`)
    .then(res => {
        if (!res.status) {
            localStorage.removeItem('token')
            window.location.href = "/"
        }
    })
    .catch(err => {
        console.log(err)
    })
})

export default router