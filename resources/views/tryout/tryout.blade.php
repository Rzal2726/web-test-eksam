<!doctype html>
<html lang="en">
<head>
    <title>Try Out - Pengerjaan Soal</title>
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
    <main class="container my-5 py-4">
        <div class="card p-4 shadow-sm mb-3" id="soal-card"></div>
        <div id="option-card" class="mb-4"></div>

        <div class="d-flex justify-content-between flex-wrap gap-2">
            <button id="prevBtn" onclick="prevQuestion()" class="btn btn-outline-primary flex-grow-1 flex-sm-grow-0">Sebelumnya</button>
            <button id="nextBtn" onclick="nextQuestion()" class="btn btn-primary flex-grow-1 flex-sm-grow-0">Selanjutnya</button>
        </div>
    </main>

    <!-- Modal: Konfirmasi Selesai -->
    <div class="modal fade" id="selesaiModal" tabindex="-1" aria-labelledby="selesaiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Selesai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin sudah menyelesaikan semua soal? Nilai kamu akan dihitung dan dikirim.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="confirmSelesaiBtn" onclick="calculateTotalScore()">Ya, Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Lapor Soal -->
    <div class="modal fade" id="modalId" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporkan Soal</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label for="editor1" class="form-label">Keterangan</label>
                    <textarea id="editor1" class="form-control" rows="4"></textarea>
                </div>
                <div class="modal-footer">
                    <button onclick="report()" class="btn btn-danger">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    @include('component.footer')
    <!-- Scripts -->
    @include('component.scripts')
    <script>
        document.getElementById('user').innerText = localStorage.getItem('username') || 'User';
    </script>
    <script src="{{ asset('/assets/js/tryout.js') }}" defer></script>

</body>
</html>
