function barang() {
    axios.get('https://local.tainan-enterprises-inventory.test/api/barang/' + document.getElementById("barangId").value)
        .then(function (response) {
            if (response.status == 200) {
                localStorage.setItem('barangName', response.data.nama_barang);

                document.getElementById('barangName').value = localStorage.getItem('barangName');
            } else {
                document.getElementById('barangName').value = 'Something wrong...'
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}
