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
            path: '/dokumen-pemasukan',
            name: 'pemasukan',
            component: require('./components/DokumenKepabeanan/Pemasukan.vue').default
        },
        {
            path: '/dokumen-pengeluaran',
            name: 'pengeluaran',
            component: require('./components/DokumenKepabeanan/Pengeluaran.vue').default
        },
        // Outbound
        {
            path: '/transaksi-outbound',
            name: 'transaksi',
            component: require('./components/Outbound/Transaksi.vue').default
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
            name: 'inventory',
            component: require('./components/Allotment/Inventory.vue').default
        },
        {
            path: '/movement-allotment',
            name: 'movement',
            component: require('./components/Allotment/Movement.vue').default
        },
        // Mutasi
        {
            path: '/report-mutasi',
            name: 'report-mutasi',
            component: require('./components/Mutasi/ReportMutasi.vue').default,
            props: true
        },
        {
            path: '/mutasi-berkala',
            name: 'mutasi-berkala',
            component: require('./components/Mutasi/MutasiBerkala.vue').default
        },
        {
            path: '/perhitungan-mutasi',
            name: 'perhitungan-mutasi',
            component: require('./components/Mutasi/PerhitunganMutasi.vue').default
        },
        // Scrap
        {
            path: '/scrap',
            name: 'scrap',
            component: require('./components/Scrap/Scrap.vue').default
        },
        // Masa Timbun
        {
            path: '/masa-timbun',
            name: 'masa-timbun',
            component: require('./components/MasaTimbun/MasaTimbun.vue').default
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