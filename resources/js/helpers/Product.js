export function Updateproduct(product) {
    return new Promise((res, rej) => {
        axios.patch(`products/${product.id}`, product)
            .then(response => {
                alert('success')
                // this.loading = false;
                // console.log(response);
                // this.close()
                // this.product = response.data;
                // context.commit('getProducts', response.data)
            })
            .catch(error => {
                alert('failed')
                //// console.log(error.response);
                // this.loading = false;
            });
    })
}