export default {
    loading(state, payload) {
        state.loading = payload
    },
    error(state, payload) {
        state.error = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },
    updateUsersList(state, payload) {
        state.users = payload
    },
    updateRoleList(state, payload) {
        state.roles = payload
    },
    updateproduct_warehouseList(state, payload) {
        state.product_warehouse = payload
    },
    updateProductsList(state, payload) {
        state.products = payload
    },
    updateboxesList(state, payload) {
        state.boxes = payload
    },
    updatetypeList(state, payload) {
        state.types = payload
    },
    updatewarehouseBoxesList(state, payload) {
        state.warehouseBoxes = payload
    },
    updateDeliveryList(state, payload) {
        state.delivery = payload
    },
    updateTransferList(state, payload) {
        state.transfer = payload
    },
    updateRecTransferList(state, payload) {
        state.recTransfer = payload
    },
    updateReceiveList(state, payload) {
        state.received = payload
    },
    updateHistoryList(state, payload) {
        state.history = payload
    },
    updateOnholdList(state, payload) {
        state.onhold = payload
    },
    updatewarehouseList(state, payload) {
        state.warehouse = payload
    },
    updateClientList(state, payload) {
        state.clients = payload
    },
    updateclassificationsList(state, payload) {
        state.classifications = payload
    },
    updateOrderItemList(state, payload) {
        state.orders = payload
    },
    updateOrderHistoryList(state, payload) {
        state.orderHistory = payload
    },
    updatePackageList(state, payload) {
        state.packages = payload
    },
    updateOrderEditList(state, payload) {
        state.order_update = payload
    },
    updateReceiverList(state, payload) {
        state.receivers = payload
    },
    updateDeliveryMethodList(state, payload) {
        state.delivery_methods = payload
    },
    updateOrderList(state, payload) {
        state.saleorders = payload
    },
    updateSaleList(state, payload) {
        state.sales = payload
    },
    updateSearchList(state, payload) {
        state.seachResults = payload
    },
    updateClientSearchList(state, payload) {
        state.seachClient = payload
    },
    updateGroupList(state, payload) {
        state.groups = payload
    },
    updateReturnList(state, payload) {
        state.returns = payload
    },
    updateReturnSearchList(state, payload) {
        state.returns_search = payload
    },
    updateCategoryList(state, payload) {
        state.category = payload
    },
    updateSubvariantList(state, payload) {
        state.subvariant = payload
    },
    updateAttributeList(state, payload) {
        state.attributes = payload
    },

    // Dashboard
    updateLowStock(state, payload) {
        state.low_stoke = payload
    },
    updateOnhand(state, payload) {
        state.onhand = payload
    },
    updateProductCount(state, payload) {
        state.product_count = payload
    },
    updateToReceive(state, payload) {
        state.tobe_received = payload
    },

    // Chart
    updateChartsummary(state, payload) {
        state.chartsummary = payload
    },
    updateActiveProductsChart(state, payload) {
        state.active_chart = payload
    },


    // Notifications
    updatenotifications(state, payload) {
        state.notifications = payload
    },

    // Unique
    updateunique_sku(state, payload) {
        state.unique_sku = payload
    },
}
