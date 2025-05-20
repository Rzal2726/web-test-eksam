<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi TryOut</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <style>
    body {
    background: linear-gradient(96deg, rgba(63, 94, 251, 1) 0%, rgba(252, 70, 107, 1) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .register-card {
        color: white;
      max-width: 420px;
      width: 100%;
      padding: 2rem;
      border-radius: 1rem;

      background-color: rgba(255, 255, 255, 0.2); /* Putih semi-transparan */
        backdrop-filter: blur(10px); /* Blur latar belakang */
        -webkit-backdrop-filter: blur(10px); /* Dukungan Safari */
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .input{
        background-color: transparent !important;
        border: none;
        border-bottom: 2px solid rgb(255, 255, 255);
        border-radius: 0;
        color: #ffffff !important;
    }
    .input::placeholder{
        color: #ffffff97 !important;
    }
    .input:focus{
        background-color: transparent !important;
        border: none;
        border-bottom: 2px solid rgb(255, 255, 255);
        border-radius: 0;
        color: #ffffff !important;
    }

    .input:-webkit-autofill,
    .input:-webkit-autofill:focus,
    .input:-webkit-autofill:hover,
    .input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 1000px transparent inset !important;
        box-shadow: 0 0 0 1000px transparent inset !important;
        -webkit-text-fill-color: #ffffff !important;
        transition: background-color 5000s ease-in-out 0s !important;
    }


    .bx-user-circle {
      font-size: 3.5rem;
      color: #0d6efd;
    }

    .input-group-text {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    @media (max-width: 576px) {
      .register-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="card shadow register-card">
    <div class="text-center mb-4">
      <i class="bx bx-book fs-1 text-primary"></i>
      <h4 class="mt-2">Registrasi TryOut</h4>
    </div>

    <div class="alert alert-danger d-none" role="alert"></div>

    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" class="form-control input" id="name" name="name" placeholder="John Doe" required />
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control input" id="email" name="email" placeholder="example@gmail.com" required />
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control input" id="password" name="password" placeholder="*****" required />
        <span class="input-group-text input" id="togglePassword">
          <i class='bx bx-hide fs-5'></i>
        </span>
      </div>
    </div>

    <div class="mb-4">
      <label for="confirm-password" class="form-label">Konfirmasi Password</label>
      <div class="input-group">
        <input type="password" class="form-control input" id="confirm-password" name="confirm-password" placeholder="*****" required />
        <span class="input-group-text input" id="toggleConfirmPassword">
          <i class='bx bx-hide fs-5'></i>
        </span>
      </div>
    </div>

    <button type="button" onclick="register()" class="btn btn-primary w-100">Daftar</button>
    <p class="text-center mt-3 mb-0">
      Sudah memiliki akun? <a href="/" class="text-info">Login di sini</a>
    </p>
  </div>

  <!-- JS CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-loading-overlay@1.2.0/dist/js-loading-overlay.min.js"></script>
  <script src="{{ asset('/assets/js/register.js') }}" defer></script>

  <script>
    // Toggle Password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    togglePassword.addEventListener('click', () => {
      const isHidden = passwordInput.type === 'password';
      passwordInput.type = isHidden ? 'text' : 'password';
      togglePassword.innerHTML = `<i class='bx ${isHidden ? 'bx-show' : 'bx-hide'} fs-5'></i>`;
    });

    // Toggle Confirm Password
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirm-password');
    toggleConfirmPassword.addEventListener('click', () => {
      const isHidden = confirmPasswordInput.type === 'password';
      confirmPasswordInput.type = isHidden ? 'text' : 'password';
      toggleConfirmPassword.innerHTML = `<i class='bx ${isHidden ? 'bx-show' : 'bx-hide'} fs-5'></i>`;
    });
  </script>
</body>
</html>
