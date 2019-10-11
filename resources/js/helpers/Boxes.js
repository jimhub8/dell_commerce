export function boxes(box) {
    return new Promise((res, rej) => {
        axios.patch(`boxes/${box.id}`, box)
            .then(response => {
                alert('success')
                // this.loading = false;
                // console.log(response);
                // this.close()
                // this.box = response.data;
            })
            .catch(error => {
                alert('failed')
                //// console.log(error.response);
                // this.loading = false;
            });
    })
}