<!doctype html>
<html lang="en">
<head>
    <title>Try Out - Welcome</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    
    <style>
        html, body {
        height: 100%;
        }

        body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        }

        main {
        flex: 1;
        }
      /* Contoh styling khusus agar card dan button tidak terlalu mepet di layar kecil */
      #soal-card {
        min-height: 200px;
        word-wrap: break-word;
      }
      .gradient{
        background: linear-gradient(96deg, rgba(63, 94, 251, 1) 0%, rgba(252, 70, 107, 1) 100%);

      }
      /* Supaya tombol di mobile gak terlalu kecil dan saling menempel */
      @media (max-width: 576px) {
        #prevBtn, #nextBtn {
          flex: 1 1 48%;
          font-size: 1rem;
          padding: 0.5rem 0;
        }
        .d-flex.justify-content-between {
          gap: 8px;
        }
      }
    </style>
</head>
<body class="bg-light">

    @include('component.nav')

    <!-- Main Content -->
    <main class="container my-5 py-4 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
  <div class="card shadow text-center p-4 w-100" style="max-width: 500px;">
    <h3 class="mb-4" id="greet">Mulai Try Out</h3>

    <!-- Tombol Bulat -->
    <a href="/tryout/tryout"
       class="btn btn-outline-primary rounded-circle d-flex justify-content-center align-items-center mx-auto"
       style="width: 90px; height: 90px;">
       <i class="bx bx-play" style="font-size: 2rem;"></i>
    </a>

    <div class="mt-3">Klik Tombol Di Atas Untuk Mulai Tryout</div>
    <div class="mt-3" id="last-nilai"></div>
  </div>
</main>





    @include('component.footer')
    <!-- Scripts -->
    @include('component.scripts')
      <script src="{{ asset('/assets/js/welcome.js') }}" defer></script>

    <script>
        document.getElementById('user').innerText = localStorage.getItem('username') || 'User';
        document.getElementById('last-nilai').innerText = "Nilai Terakhir: "+(localStorage.getItem('last-score') || 'Tidak Ada');
        document.getElementById('greet').innerText = 'Selamat Datang '+localStorage.getItem('username')+' di Try Out' || 'User'+' di TryOut';
    </script>
</body>
</html>
