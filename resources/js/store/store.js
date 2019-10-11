import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        loading: false,
        error: null,
        users: [],
        roles: [],
        products: [],
        boxes: [],
        types: [],
        classifications: [],
        warehouseBoxes: [],
        delivery: [],
        recTransfer: [],
        transfer: [],
        received: [],
        onhold: [],
        packages: [],
        warehouse: [],
        clients: [],
        history: [],
        saleorders: [],
        delivery_methods: [],
        seachResults: [],
        sales: [],
        orderHistory: [],
        orders: [],
        seachClient: [],
        order_update: [],
        returns: [],
        returns_search: [],
        receivers: [],
        attributes: [],
        subvariant: [],
        groups: [],
        category: [],
        product_warehouse: [],

        // Dashboard
        low_stoke: null,
        onhand: null,
        product_count: null,
        tobe_received: null,

        // Charts
        chartsummary: [],
        active_chart: [],

        // Notifications
        notifications: [],

        // Unique
        unique_sku: [],
    },
    getters,
    mutations,
    actions
}
