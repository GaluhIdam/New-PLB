import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/home',
            name: 'home',
            component: require('./components/Home.vue').default
        },

        // Dokumen Kepabeanan
        {
            path: '/inbound-document',
            name: 'inbound-document',
            component: require('./components/Costums/InboundDocument.vue').default
        },
        {
            path: '/outbound-document',
            name: 'outbound-document',
            component: require('./components/Costums/OutboundDocument.vue').default
        },
        // Outbound
        {
            path: '/outbound-transcation-1',
            name: 'outbound-transcation-1',
            component: require('./components/Outbound/Transaction1.vue').default
        },
        {
            path: '/outbound-transcation-2',
            name: 'outbound-transcation-2',
            component: require('./components/Outbound/Transaction2.vue').default
        },
        {
            path: '/outbound-transcation-3',
            name: 'outbound-transcation-3',
            component: require('./components/Outbound/Transaction3.vue').default
        },
        {
            path: '/summary-outbound',
            name: 'summary',
            component: require('./components/Outbound/Summary.vue').default
        },
        // Mutasi Pesawat
        {
            path: '/mutation',
            name: 'mutation',
            component: require('./components/Aircraft/Mutation.vue').default
        },
        {
            path: '/delivery',
            name: 'delivery',
            component: require('./components/Aircraft/Delivery.vue').default
        },
        {
            path: '/redelivery',
            name: 'redelivery',
            component: require('./components/Aircraft/Redelivery.vue').default
        },
        // Allotment
        {
            path: '/inventory-allotment',
            name: 'inventory-allotment',
            component: require('./components/Allotment/Inventory.vue').default
        },
        {
            path: '/movement-allotment',
            name: 'movement-allotment',
            component: require('./components/Allotment/Movement.vue').default
        },
        // Mutasi
        {
            path: '/report-mutation',
            name: 'report-mutation',
            component: require('./components/Mutation/ReportMutation.vue').default,
            props: true
        },
        {
            path: '/periodic-mutation',
            name: 'periodic-mutation',
            component: require('./components/Mutation/PeriodicMutation.vue').default
        },
        {
            path: '/calculation-mutation',
            name: 'calculation-mutation',
            component: require('./components/Mutation/CalculationMutation.vue').default
        },
        // Scrap
        {
            path: '/scrap',
            name: 'scrap',
            component: require('./components/Scrap/Scrap.vue').default
        },
        // Masa Timbun
        {
            path: '/hoarding-time',
            name: 'hoarding-time',
            component: require('./components/HoardingTime/HoardingTime.vue').default
        },
        // User Management
        {
            path: '/users-list',
            name: 'users-list',
            component: require('./components/UserManagement/UsersList.vue').default,
            props: true
        },
        {
            path: '/users-role',
            name: 'users-role',
            component: require('./components/UserManagement/UsersRole.vue').default
        },
        // Log
        {
            path: '/login-history',
            name: 'login-history',
            component: require('./components/Log/LoginHistory.vue').default,
            props: true
        },
        {
            path: '/activity-history',
            name: 'activity-history',
            component: require('./components/Log/ActivityHistory.vue').default
        },
    ]
});

export default router;