const endpoints = {
    register: "https://api-test.eksam.cloud/api/v1/auth/register"
}

async function register() {
    try {
        let name = document.getElementById('name');
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        let confirmPassword = document.getElementById('confirm-password');

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name.value.trim() === "") {
            name.focus();
            toastr.error("Kolom nama tidak boleh kosong");
            return false;
        }

        if (email.value.trim() === "") {
            email.focus();
            toastr.error("Kolom email tidak boleh kosong");
            return false;
        }

        if (!emailPattern.test(email.value.trim())) {
            email.focus();
            toastr.error("Format email tidak valid");
            return false;
        }

        if (password.value === "") {
            password.focus();
            toastr.error("Kolom password tidak boleh kosong");
            return false;
        }

        if (confirmPassword.value === "") {
            confirmPassword.focus();
            toastr.error("Kolom konfirmasi password tidak boleh kosong");
            return false;
        }

        if (confirmPassword.value !== password.value) {
            confirmPassword.focus();
            toastr.error("Password dan konfirmasi password tidak sesuai!");
            return false;
        }

        JsLoadingOverlay.show();

        const response = await fetch(endpoints.register, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name.value.trim(),
                email: email.value.trim(),
                password: password.value
            })
        });

        const data = await response.json();

        if (response.ok) {
            JsLoadingOverlay.hide();
            toastr.success("Berhasil Registrasi");
            window.location.href = '/';
        } else {
            JsLoadingOverlay.hide();
            toastr.error(data.message || 'Registrasi gagal!');
        }
    } catch (e) {
        JsLoadingOverlay.hide();
        console.error("Error:", e);
        const message = e?.message || 'Terjadi kesalahan saat registrasi.';
        toastr.error(message);
    }
}
