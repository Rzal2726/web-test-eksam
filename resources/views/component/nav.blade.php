<nav class="navbar navbar-expand-lg gradient text-white shadow-sm">
    <div class="container text-white">
        <a class="navbar-brand fw-bold text-white">Aplikasi TryOut</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbarContent">
            <ul class="navbar-nav me-auto text-white"></ul>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span class="fw-semibold d-flex align-items-center gap-1">
                    <i class='bx bx-user-circle text-white'></i>
                    <span class="text-white" id="user"></span>
                </span>
                <button onclick="logout()" class="btn btn-outline-light btn-sm">Logout</button>
            </div>
        </div>
    </div>
</nav>
