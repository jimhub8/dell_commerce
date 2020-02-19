import axios from "axios";
export default {
    alertEvent(context, payload) {
        eventBus.$emit('alertRequest', payload)
        // context.commit('alertEvent', payload)
    },

    errorEvent(context, payload) {
        eventBus.$emit('errorEvent', payload)
        // context.commit('alertEvent', payload)
    },

    // GET
    getUsers(context) {
        context.commit('loading', true)
        axios.get('/users').then((response) => {
            context.commit('updateUsersList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getRoles(context) {
        context.commit('loading', true)
        axios.get('/roles').then((response) => {
            context.commit('updateRoleList', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getProducts(context) {
        context.commit('loading', true)
        axios.get('/products').then((response) => {
            context.commit('updateProductsList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getBoxes(context) {
        context.commit('loading', true)
        axios.get('/boxes').then((response) => {
            context.commit('updateboxesList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getTypes(context) {
        context.commit('loading', true)
        axios.get('/type').then((response) => {
            context.commit('updatetypeList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getClassifications(context) {
        context.commit('loading', true)
        axios.get('/classifications').then((response) => {
            context.commit('updateclassificationsList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    gethistory(context) {
        context.commit('loading', true)
        axios.get('/history').then((response) => {
            context.commit('updateHistoryList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getreceive(context) {
        context.commit('loading', true)
        axios.get('/receive').then((response) => {
            context.commit('updateReceiveList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getwarehouseBoxes(context) {
        context.commit('loading', true)
        axios.get('/warehouseBoxes').then((response) => {
            context.commit('updatewarehouseBoxesList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getDelivery(context) {
        context.commit('loading', true)
        axios.get('/delivery').then((response) => {
            context.commit('updateDeliveryList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    receiveTransfer(context) {
        context.commit('loading', true)
        axios.get('/receiveTransfer').then((response) => {
            context.commit('updateRecTransferList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getTransfer(context) {
        context.commit('loading', true)
        axios.get('/transfer').then((response) => {
            context.commit('updateTransferList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getonHold(context) {
        context.commit('loading', true)
        axios.get('/onhold').then((response) => {
            context.commit('updateOnholdList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getWarehouses(context) {
        context.commit('loading', true)
        axios.get('/warehouses').then((response) => {
            context.commit('updatewarehouseList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getClients(context) {
        context.commit('loading', true)
        axios.get('/clients').then((response) => {
            context.commit('updateClientList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getGroups(context) {
        context.commit('loading', true)
        axios.get('/groups').then((response) => {
            context.commit('updateGroupList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getReceivers(context) {
        context.commit('loading', true)
        axios.get('/receiver').then((response) => {
            context.commit('updateReceiverList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getsaleOrders(context) {
        context.commit('loading', true)
        axios.get('/saleorders').then((response) => {
            context.commit('updateOrderList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    orderhistory(context) {
        context.commit('loading', true)
        axios.get('/orderHistory').then((response) => {
            context.commit('updateOrderHistoryList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getSales(context) {
        context.commit('loading', true)
        axios.get('/sales').then((response) => {
            context.commit('updateSaleList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    product_warehouse(context, payload) {
        context.commit('loading', true)
        axios.get(`/products/${payload}`)
            .then((response) => {
                context.commit('updateproduct_warehouseList', response.data)
                context.commit('loading', false)
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },
    getOrders(context) {
        context.commit('loading', true)
        axios.get('/saleorders').then((response) => {
            context.commit('updateOrderItemList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getOrderUpdate(context, payload) {
        context.commit('loading', true)
        axios.get(`/saleorders/${payload}`).then((response) => {
            context.commit('updateOrderEditList', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getDelieryMethod(context) {
        context.commit('loading', true)
        axios.get('/deliverymethod').then((response) => {
            context.commit('updateDeliveryMethodList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    getPackages(context) {
        context.commit('loading', true)
        axios.get('/packages').then((response) => {
            context.commit('updatePackageList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getCategory(context) {
        context.commit('loading', true)
        axios.get('/category').then((response) => {
            context.commit('updateCategoryList', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getSubvariant(context) {
        context.commit('loading', true)
        axios.get('/subvariant').then((response) => {
            context.commit('updateSubvariantList', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getAttributes(context) {
        context.commit('loading', true)
        axios.get('/attributes').then((response) => {
            context.commit('updateAttributeList', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },


    searchItems(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post(`/searchItems/${payload}`).then((response) => {
            context.commit('updateSearchList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    searchClient(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.get(`/searchClient/${payload}`).then((response) => {
            context.commit('updateClientSearchList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    searchReceiver(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.get(`/searchReceiver/${payload}`).then((response) => {
            context.commit('updateClientSearchList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    searchReturns(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.get(`/searchReturns/${payload}`).then((response) => {
            context.commit('updateReturnSearchList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    searchOrders(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.get(`/searchOrders/${payload}`).then((response) => {
            context.commit('updateOrderItemList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },


    getReturns(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.get('/returns').then((response) => {
            context.commit('updateReturnList', response.data)
            context.commit('loading', false)
        }).catch((error) => {

            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // POST
    postOrder(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post('/saleorders', payload)
            .then((response) => {
                // alert('testtttt')
                context.commit('loading', false)
                console.log(response);

                // eventBus.$emit("stopLoadingEvent");
                // context.commit('alertEvent','Success')
                alert('Order added')
                return

                // eventBus.$emit('alertEvent', 'Success')
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                this.errors = error.response.data.errors
                return
            })
    },
    filterOrders(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post('/filterOrders', { req: payload })
            .then((response) => {
                context.commit('updateOrderItemList', response.data)
                // eventBus.$emit("stopLoadingEvent");
                context.commit('loading', false)
            }).catch((error) => {

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },
    filterReceived(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post('/filterReceived', { req: payload })
            .then((response) => {
                context.commit('updateReceiveList', response.data)
                // eventBus.$emit("stopLoadingEvent");
                context.commit('loading', false)
            }).catch((error) => {

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },

    filterReturn(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post('/filterReturns', { req: payload })
            .then((response) => {
                context.commit('updateReturnList', response.data)
                // eventBus.$emit("stopLoadingEvent");
                context.commit('loading', false)
            }).catch((error) => {

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },

    filterProd_table(context, payload) {
        // console.log(payload);
        context.commit('loading', true)
        axios.post('/filterProd_table', { req: payload })
            .then((response) => {
                context.commit('updateProductsList', response.data)
                // eventBus.$emit("stopLoadingEvent");
                context.commit('loading', false)
            }).catch((error) => {

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },

    updateSelected(context, { url, checked }) {
        console.log(checked);
        context.commit('loading', true)
        axios.post(url, checked)
            .then((response) => {
                // context.commit('updateProductsList', response.data)
                context.commit('loading', false)
            }).catch((error) => {
                context.commit('loading', false)

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                }
                context.commit('loading', false)
                this.errors = error.response.data.errors
            })
    },



    // Dashboard
    getLowstock(context) {
        context.commit('loading', true)
        axios.get('/lowstock').then((response) => {
            context.commit('updateLowStock', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getOnhand(context) {
        context.commit('loading', true)
        axios.get('/onhand').then((response) => {
            context.commit('updateOnhand', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    product_count(context) {
        context.commit('loading', true)
        axios.get('/product_count').then((response) => {
            context.commit('updateProductCount', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    tobe_received(context) {
        context.commit('loading', true)
        axios.get('/tobe_received').then((response) => {
            context.commit('updateToReceive', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Charts

    getChartSummary(context) {
        context.commit('loading', true)
        axios.get('/chartSummary').then((response) => {
            context.commit('updateChartsummary', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },
    getActiveProducts(context) {
        context.commit('loading', true)
        axios.get('/active_products').then((response) => {
            context.commit('updateActiveProductsChart', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Notifications
    getnotifications(context) {
        context.commit('loading', true)
        axios.get('/notifications').then((response) => {
            context.commit('updatenotifications', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },


    // Unique
    getunique_sku(context) {
        context.commit('loading', true)
        axios.get('/unique_sku').then((response) => {
            context.commit('updateunique_sku', response.data)
            context.commit('loading', false)
        }).catch((error) => {
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },







    // Get Data
    getData(context, payload) {
        var model = payload.model
        var update = payload.update
        context.commit('loading', true)
        axios.get(model).then((response) => {
            context.commit(update, response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Post
    postData(context, payload) {
        var model = payload.model
        var data = payload.data
        context.commit('loading', true)
        axios.post(model, data).then((response) => {
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Patch
    patchData(context, payload) {
        var model = payload.model
        var id = payload.id
        var data = payload.data
        context.commit('loading', true)
        axios.post(model + '/' + id, data).then((response) => {
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Filter Data
    filterData(context, payload) {
        var model = payload.model
        var update = payload.update
        var data = payload.data
        context.commit('loading', true)
        axios.post(model, data).then((response) => {
            context.commit(update, response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

    // Search Data
    searchData(context, payload) {
        var model = payload.model
        var update = payload.update
        var search = payload.search
        context.commit('loading', true)
        axios.get(model + '/' + search).then((response) => {
            context.commit(update, response.data)
            context.commit('loading', false)
        }).catch((error) => {
            if (error.response.status === 500) {
                eventBus.$emit('errorEvent', error.response.statusText)
                return
            } else if (error.response.status === 401 || error.response.status === 409) {
                eventBus.$emit('reloadRequest', error.response.statusText)
            }
            context.commit('loading', false)
            this.errors = error.response.data.errors
        })
    },

}
