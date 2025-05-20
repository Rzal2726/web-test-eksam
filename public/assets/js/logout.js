const endpoint = {
    logout: "https://api-test.eksam.cloud/api/v1/auth/logout",
};

async function logout() {
    try {
        const result = await Swal.fire({
            title: "Yakin ingin logout?",
            text: "Kamu akan diarahkan ke halaman login",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, logout!",
            cancelButtonText: "Batal"
        });

        if (result.isConfirmed) {
            JsLoadingOverlay.show();
            const response = await fetch(endpoint.logout, {
                method: "POST",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            const data = await response.json();

            if (response.ok) {
                toastr.success("Berhasil Logout");
                localStorage.clear();
                window.location.href = '/';
            } else {
                toastr.error(data.message || 'Logout gagal!');
            }
            JsLoadingOverlay.hide();
        }
    } catch (e) {
        console.log(e);
        JsLoadingOverlay.hide();
    }
}

function load(){
    JsLoadingOverlay.show();
    setTimeout(() => {
        JsLoadingOverlay.hide();
    },1000);
}