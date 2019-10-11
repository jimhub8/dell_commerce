export default {
    loading(state) {
        return state.loading;
    },
    error(state) {
        return state.error;
    },
    alertEvent(state) {
        eventBus.$emit('alertEvent', state)
        // return state.alertEvent;
    },
    users(state) {
        return state.users
    },
    roles(state) {
        return state.roles
    },
    products(state) {
        return state.products
    },
    receivers(state) {
        return state.receivers
    },
    boxes(state) {
        return state.boxes
    },
    types(state) {
        return state.types
    },
    classifications(state) {
        return state.classifications
    },
    delivery(state) {
        return state.delivery;
    },
    transfer(state) {
        return state.transfer;
    },
    recTransfer(state) {
        return state.recTransfer;
    },
    received(state) {
        return state.received;
    },
    warehouseBoxes(state) {
        return state.warehouseBoxes;
    },
    history(state) {
        return state.history;
    },
    packages(state) {
        return state.packages;
    },
    onhold(state) {
        return state.onhold;
    },
    groups(state) {
        return state.groups;
    },
    warehouse(state) {
        return state.warehouse;
    },
    clients(state) {
        return state.clients;
    },
    saleorders(state) {
        return state.saleorders;
    },
    orderHistory(state) {
        return state.orderHistory;
    },
    product_warehouse(state) {
        return state.product_warehouse
    },
    delivery_methods(state) {
        return state.delivery_methods;
    },
    orders(state) {
        return state.orders;
    },
    sales(state) {
        return state.sales;
    },
    order_update(state) {
        return state.order_update;
    },
    seachResults(state) {
        return state.seachResults;
    },
    seachClient(state) {
        return state.seachClient;
    },
    returns(state) {
        return state.returns;
    },
    returns_search(state) {
        return state.returns_search;
    },
    category(state) {
        return state.category;
    },
    subvariant(state) {
        return state.subvariant;
    },
    attributes(state) {
        return state.attributes;
    },

    // Dashboard
    low_stoke(state) {
        return state.low_stoke;
    },
    onhand(state) {
        return state.onhand;
    },
    product_count(state) {
        return state.product_count;
    },
    tobe_received(state) {
        return state.tobe_received;
    },

    // Charts
    chartsummary(state) {
        return state.chartsummary;
    },
    active_chart(state) {
        return state.active_chart;
    },

    // Notifications
    notifications(state) {
        return state.notifications;
    },

    // Unique
    unique_sku(state) {
        return state.unique_sku;
    },
}
