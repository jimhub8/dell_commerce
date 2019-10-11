<template>

</template>

<script>
export default {
    name: "attribute-values",
    props: ['attributeid'],
    data() {
        return {
            values: [],
            value: '',
            price: '',
            currentId: '',
            addValue: true,
            key: 0,
        }
    },
    created: function () {
        this.loadValues();
    },
    methods: {
        loadValues() {
            let attributeId = this.attributeid;
            let _this = this;
            axios.post('/get-values', {
                id: attributeId
            }).then(function (response) {
                _this.values = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        saveValue() {
            if (this.value === '') {
                this.$swal("Error, Value for attribute is required.", {
                    icon: "error",
                });
            } else {
                let attributeId = this.attributeid;
                let _this = this;
                axios.post('/admin/attributes/add-values', {
                    id: attributeId,
                    value: _this.value,
                    price: _this.price,
                }).then(function (response) {
                    _this.values.push(response.data);
                    _this.resetValue();
                    _this.$swal("Success! Value added successfully!", {
                        icon: "success",
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        resetValue() {
            this.value = '';
            this.price = '';
        },
        reset() {
            this.addValue = true;
            this.resetValue();
        },
        editAttributeValue(value) {
            this.addValue = false;
            this.value = value.value;
            this.price = value.price;
            this.currentId = value.id;
            this.key = this.values.indexOf(value);
        },
        updateValue() {
    if (this.value === '') {
        this.$swal("Error, Value for attribute is required.", {
            icon: "error",
        });
    } else {
        let attributeId = this.attributeid;
        let _this = this;
        axios.post('/admin/attributes/update-values', {
            id: attributeId,
            value: _this.value,
            price: _this.price,
            valueId: _this.currentId
        }).then (function(response){
            _this.values.splice(_this.key, 1);
            _this.resetValue();
            _this.values.push(response.data);
            _this.$swal("Success! Value updated successfully!", {
                icon: "success",
            });
        }).catch(function (error) {
            console.log(error);
        });
    }
},
deleteAttributeValue(value) {
    this.$swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this attribute value!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            this.currentId = value.id;
            this.key = this.values.indexOf(value);
            let _this = this;
            axios.post('/admin/attributes/delete-values', {
                id: _this.currentId
            }).then (function(response){
                if (response.data.status === 'success') {
                    _this.values.splice(_this.key, 1);
                    _this.resetValue();
                    _this.$swal("Success! Option value has been deleted!", {
                        icon: "success",
                    });
                } else {
                    _this.$swal("Your option value not deleted!");
                }
            }).catch(function (error) {
                console.log(error);
            });
        } else {
            this.$swal("Your option value not deleted!");
        }
    });
},
    }
}
</script>
