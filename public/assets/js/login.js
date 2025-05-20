const endpoints = {
    login: "https://api-test.eksam.cloud/api/v1/auth/login"
}

async function login() {
    try {
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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

        if (password.value.trim() === "") {
            password.focus();
            toastr.error("Kolom password tidak boleh kosong");
            return false;
        }

        JsLoadingOverlay.show();

        const response = await fetch(endpoints.login, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email.value.trim(),
                password: password.value
            })
        });

        const data = await response.json();

        if (response.ok) {
            JsLoadingOverlay.hide();
            toastr.success("Berhasil Login");
            localStorage.setItem("token", data.data?.access_token);
            localStorage.setItem("username", data.data?.user?.name);
            window.location.href = '/tryout';
        } else {
            JsLoadingOverlay.hide();
            toastr.error(data.message || 'Login gagal!');
        }
    } catch (e) {
        JsLoadingOverlay.hide();
        console.error("Error:", e);
        const message = e?.message || 'Terjadi kesalahan saat login.';
        toastr.error(message);
    }
}
