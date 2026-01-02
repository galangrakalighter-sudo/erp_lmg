@include('partials.header')

<style>
    :root {
        --bs-primary: #4f46e5;
        --bs-primary-rgb: 79, 70, 229;
    }

    .main-instruction-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding-top: 3rem;
        padding-bottom: 4rem;
    }

    .main-card {
        background: white;
        border-radius: 40px;
        border: 1px solid #e2e8f0;
        padding: 3rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        min-height: 600px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .step-indicator-text {
        color: var(--bs-primary);
        font-weight: 800;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
        display: block;
    }

    /* CONTAINER GAMBAR INSTRUKSI */
    .step-image-wrapper {
        background-color: #f8fafc;
        border-radius: 24px;
        border: 2px dashed #e2e8f0;
        margin: 1.5rem 0;
        overflow: hidden;
        position: relative;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-image-wrapper img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        display: none; /* Muncul via JS */
        padding: 1rem;
    }

    .image-loader {
        position: absolute;
        color: #94a3b8;
        text-align: center;
    }

    .tips-box {
        background-color: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
    }

    .btn-step-nav {
        padding: 0.75rem 2rem;
        border-radius: 14px;
        font-weight: 700;
        transition: all 0.2s;
    }

    @media (max-width: 768px) {
        .main-card { padding: 1.5rem; border-radius: 24px; }
        .step-image-wrapper { min-height: 250px; }
    }
</style>

<div class="container main-instruction-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            
            <div class="text-center mb-4">
                <span class="step-indicator-text">Langkah <span id="current-step-num">1</span> dari 10</span>
            </div>

            <div class="main-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="p-3 bg-light rounded-4 text-primary" id="step-icon-container">
                        <i data-lucide="globe" class="size-32"></i>
                    </div>
                    <div>
                        <span class="text-muted fw-bold small text-uppercase" id="step-label">Langkah 1</span>
                        <h2 class="fw-bold mb-0" id="step-title">Memuat...</h2>
                    </div>
                </div>

                <div class="flex-grow-1 mb-5">
                    <p class="fs-5 text-secondary leading-relaxed" id="step-description">
                        Sedang memuat instruksi langkah...
                    </p>
                    
                    <div class="step-image-wrapper">
                        <div class="image-loader" id="img-loader">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <p class="small fw-medium d-block">Memuat Visual...</p>
                        </div>
                        <img src="" id="step-visual" alt="Instruksi Visual">
                    </div>

                    <div class="tips-box">
                        <div class="text-warning"><i data-lucide="lightbulb"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Catatan Penting</h6>
                            <p class="small text-muted mb-0" id="step-tips"></p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                    <button class="btn btn-light btn-step-nav text-secondary" onclick="prevStep()" id="btn-prev">
                        <i data-lucide="chevron-left" class="me-2"></i> Kembali
                    </button>
                    <button class="btn btn-primary btn-step-nav" onclick="nextStep()" id="btn-next">
                        <span>Langkah Selanjutnya</span> <i data-lucide="chevron-right" class="ms-2"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const steps = [
        {
            id: 1,
            title: "Login",
            icon: "globe",
            desc: "Login Ke Meta Developer",
            tips: "Gunakan Akun Lighter Production",
            image: "{{ asset('img/langkah1.png') }}" 
        },
        {
            id: 2,
            title: "Pindah Halaman",
            icon: "shield-check",
            desc: "Tekan Tombol Aplikasi Saya",
            tips: "Tidak ada catatan",
            image: "{{ asset('img/langkah2.png')}}"
        },
        {
            id: 3,
            title: "Pilih Aplikasi",
            icon: "key",
            desc: "Pilih Aplikasi yang akan digunakan untuk dijadikan tempat Penyimpanan API",
            tips: "Pastikan sudah Membuat Aplikasi terlebih dahulu",
            image: "{{ asset('img/langkah3.png') }}"
        },
        {
            id: 4,
            title: "Siapkan Produk Instagram",
            icon: "check-circle",
            desc: "Pilih Instagram untuk di siapkan",
            tips: "Untuk Saat ini hanya bisa Instagram saja",
            image: "{{ asset('img/Langkah4.png') }}"
        },
        {
            id: 5,
            title: "Tampilan",
            icon: "check-circle",
            desc: "Tampilannya akan menjadi Seperti ini",
            tips: "Muncul Instagram",
            image: "{{ asset('img/Langkah5.png') }}"
        },
        {
            id: 6,
            title: "Tambah Akun",
            icon: "check-circle",
            desc: "Tambah Akun yang akan di sambungkan instagramnya, ke menu peran aplikasi dan peran",
            tips: "Pastikan Akun yang ditambahkan itu benar dan set akun itu sebagai penguji Instagram",
            image: "{{ asset('img/Langkah6.png') }}"
        },
        {
            id: 7,
            title: "Pergi ke Instagram",
            icon: "check-circle",
            desc: "Pergi ke Instagram yang di sambungkan sebelumnya",
            tips: "Pergi ke Setting dan ke Website Permission lalu Apps and Website, menuju Tester Invites",
            image: "{{ asset('img/Langkah7.png') }}"
        },
        {
            id: 8,
            title: "Perizinan",
            icon: "check-circle",
            desc: "Aktifkan Semua opsi lalu simpan",
            tips: "Pastikan Sudah diaktifkan semuanya",
            image: "{{ asset('img/Langkah8.png') }}"
        },
        {
            id: 9,
            title: "Tampilan",
            icon: "check-circle",
            desc: "Kembali ke Meta Developer, Pilih Instagram di sidebar lalu penyiapan api yang pertama dan Buat Token",
            tips: "Pastikan Akun sudah Tersambung",
            image: "{{ asset('img/Langkah9.png') }}"
        },
        {
            id: 10,
            title: "Salin Token",
            icon: "check-circle",
            desc: "Salin Token dan Masukan di inputan Form Access Token",
            tips: "Cek Terlebih dahulu untuk jangka waktu token nya kadaluarsa di https://developers.facebook.com/tools/explorer/",
            image: "{{ asset('img/Langkah9.png') }}"
        }
    ];

    let currentStep = 0;

    function updateUI() {
        const step = steps[currentStep];
        
        // Update Elemen Teks
        document.getElementById('current-step-num').innerText = currentStep + 1;
        document.getElementById('step-label').innerText = `Langkah ${step.id}`;
        document.getElementById('step-title').innerText = step.title;
        document.getElementById('step-description').innerText = step.desc;
        document.getElementById('step-tips').innerText = step.tips;

        // Logika Pemuatan Gambar
        const imgElement = document.getElementById('step-visual');
        const loader = document.getElementById('img-loader');
        
        imgElement.style.display = 'none'; // Sembunyikan gambar lama
        loader.style.display = 'block';    // Tampilkan loader (spinner)
        
        imgElement.src = step.image;
        imgElement.onload = function() {
            loader.style.display = 'none';
            imgElement.style.display = 'block';
        };

        // Update Icon Lucide
        const iconCont = document.getElementById('step-icon-container');
        iconCont.innerHTML = `<i data-lucide="${step.icon}" style="width:32px; height:32px"></i>`;

        // Atur Navigasi Tombol
        document.getElementById('btn-prev').style.visibility = currentStep === 0 ? 'hidden' : 'visible';
        
        const btnNext = document.getElementById('btn-next');
        if (currentStep === steps.length - 1) {
            btnNext.innerHTML = 'Selesai <i data-lucide="check" class="ms-2"></i>';
            btnNext.classList.remove('btn-primary');
            btnNext.classList.add('btn-success');
        } else {
            btnNext.innerHTML = 'Langkah Selanjutnya <i data-lucide="chevron-right" class="ms-2"></i>';
            btnNext.classList.remove('btn-success');
            btnNext.classList.add('btn-primary');
        }

        // Re-render ikon Lucide
        lucide.createIcons();
    }

    function nextStep() {
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateUI();
        } else {
            // Aksi Selesai (Misal: Redirect)
            window.location.href = `{{ route('cms.produk', 'LGTR') }}`;
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            updateUI();
        }
    }

    document.addEventListener('DOMContentLoaded', updateUI);
</script>

@include('partials.footer')