const endpoint = {
    logout: "https://api-test.eksam.cloud/api/v1/auth/logout",
};

async function logout() {
    try {
        const result = await Swal.fire({
            title: "Yakin ingin mengakhiri ujian?",
            text: "Setelah logout, kamu akan mengakhiri ujian.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, selesai!",
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