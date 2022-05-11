import Home from '../components/Home.vue'
import Delivery from '../components/Delivery.vue'
import Redelivery from '../components/Redelivery.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/delivery',
            name: 'delivery',
            component: Delivery,
        },
        {
            path: '/redelivery',
            name: 'redelivery',
            component: Redelivery,
        }
    ]
}
