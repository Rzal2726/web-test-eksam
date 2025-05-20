<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - TryOut</title>

  <!-- CSS CDN -->
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

    .login-card {
        color: white;
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 0.75rem;

      background-color: rgba(255, 255, 255, 0.2); /* Putih semi-transparan */
        backdrop-filter: blur(10px); /* Blur latar belakang */
        -webkit-backdrop-filter: blur(10px); /* Dukungan Safari */
        border: 1px solid rgba(255, 255, 255, 0.2);
=    }

    .input-group-text i {
      font-size: 1rem;
    }

    @media (max-width: 576px) {
      .login-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="card shadow login-card">
    <div class="text-center mb-3">
      <i class="bx bx-book fs-1 text-primary"></i>
      <h4 class="mt-2">Login TryOut</h4>
    </div>

    <div class="alert alert-danger d-none" role="alert"></div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control input" id="email" name="email" placeholder="example@gmail.com" required autofocus />
    </div>

    <div class="mb-4">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control input" id="password" placeholder="*****" name="password" required />
        <span class="input-group-text input" id="togglePassword" style="cursor: pointer;">
          <i class="bx bx-hide"></i>
        </span>
      </div>
    </div>

    <button type="button" onclick="login()" class="btn btn-primary w-100">Login</button>

    <p class="text-center mt-3 mb-0">
      Belum memiliki akun? <a href="/register" class="text-info">Daftar di sini</a>
    </p>
  </div>

  <!-- JS CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-loading-overlay@1.2.0/dist/js-loading-overlay.min.js"></script>
  <script src="{{ asset('/assets/js/login.js') }}" defer></script>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const icon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', () => {
      const isHidden = passwordInput.type === 'password';
      passwordInput.type = isHidden ? 'text' : 'password';
      icon.classList.toggle('bx-hide', !isHidden);
      icon.classList.toggle('bx-show', isHidden);
    });
  </script>
</body>
</html>
