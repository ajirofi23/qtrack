<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container">
            <form id="form-tambah">
                <!-- Input Nama Lengkap -->
                <div class="form-group ">
                    <label for="fullname" class="">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" placeholder=" " name="nama_lengkap" required>
                    <span id="fullname-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="fullname-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Input Nomor Telepon -->
                <div class="form-group ">
                    <label for="phoneNumber" class="">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phoneNumber" placeholder=" " name="no_tlp" required>
                    <span id="phoneNumber-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="phoneNumber-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Input Email -->
                <div class="form-group ">
                    <label for="email" class="">Alamat Email</label>
                    <input type="email" class="form-control" id="email" placeholder=" " name="email" required>
                    <span id="email-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="email-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Input Password -->
                <div class="form-group ">
                    <label for="password" class="">Password</label>
                    <input type="password" class="form-control" id="password" placeholder=" " name="password" required>
                    <span id="password-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="password-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="form-group ">
                    <label for="confirmPassword" class="">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder=" " required>
                    <span id="confirmPassword-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="confirmPassword-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Select Option Role -->
                <div class="form-group ">
                    <label for="role" class="">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="cs">CS</option>
                        <option value="teller">TELLER</option>
                    </select>
                    <span id="role-error" class="text-danger" style="font-size: 12px !important;"></span>
                    <span id="role-success" class="text-success" style="font-size: 12px !important;"></span>
                </div>

                <!-- Tombol Simpan -->
                <button id="button-simpan" class="btn btn-primary btn-sm mt-4">
                    Simpan
                </button>
                <button id="button-back" class="btn btn-danger btn-sm mt-4">
                    Kembali
                </button>
            </form>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
    // Validasi Nama Lengkap
    $('#fullname').on('keyup', function() {
        let fullname = $(this).val();
        if (fullname === "") {
            $('#fullname-error').text('Nama lengkap harus diisi.');
            $('#fullname-success').text('');
        } else {
            $('#fullname-error').text('');
            $('#fullname-success').text('Nama lengkap valid.');
        }
    });

    // Validasi Nomor Telepon
    $('#phoneNumber').on('keyup', function() {
        let phoneNumber = $(this).val();
        if (phoneNumber === "") {
            $('#phoneNumber-error').text('Nomor telepon harus diisi.');
            $('#phoneNumber-success').text('');
        } else if (!/^\d+$/.test(phoneNumber)) {
            $('#phoneNumber-error').text('Nomor telepon harus berupa angka.');
            $('#phoneNumber-success').text('');
        } else {
            $('#phoneNumber-error').text('');
            $('#phoneNumber-success').text('Nomor telepon valid.');
        }
    });

    // Validasi Email
    $('#email').on('keyup', function() {
        let email = $(this).val();
        if (email === "") {
            $('#email-error').text('Email harus diisi.');
            $('#email-success').text('');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#email-error').text('Format email tidak valid.');
            $('#email-success').text('');
        } else {
            $('#email-error').text('');
            $('#email-success').text('Email valid.');
        }
    });

    // Validasi Password
    $('#password').on('keyup', function() {
        let password = $(this).val();
        if (password === "") {
            $('#password-error').text('Password harus diisi.');
            $('#password-success').text('');
        } else if (password.length < 8) {
            $('#password-error').text('Password minimal 8 karakter.');
            $('#password-success').text('');
        } else {
            $('#password-error').text('');
            $('#password-success').text('Password valid.');
        }
    });

    // Validasi Konfirmasi Password
    $('#confirmPassword').on('keyup', function() {
        let confirmPassword = $(this).val();
        let password = $('#password').val();
        if (confirmPassword === "") {
            $('#confirmPassword-error').text('Konfirmasi password harus diisi.');
            $('#confirmPassword-success').text('');
        } else if (confirmPassword !== password) {
            $('#confirmPassword-error').text('Konfirmasi password tidak sesuai.');
            $('#confirmPassword-success').text('');
        } else {
            $('#confirmPassword-error').text('');
            $('#confirmPassword-success').text('Konfirmasi password valid.');
        }
    });

    // Validasi Role
    $('#role').on('change', function() {
        let role = $(this).val();
        if (role === "") {
            $('#role-error').text('Role harus dipilih.');
            $('#role-success').text('');
        } else {
            $('#role-error').text('');
            $('#role-success').text('Role valid.');
        }
    });

    // Tombol Simpan
    $('#button-simpan').on('click', function(e) {
        e.preventDefault();

        // Trigger validasi semua field
        $('#fullname').trigger('keyup');
        $('#phoneNumber').trigger('keyup');
        $('#email').trigger('keyup');
        $('#password').trigger('keyup');
        $('#confirmPassword').trigger('keyup');
        $('#role').trigger('change');

        // Cek apakah ada error
        let hasError = (
            $('#fullname-error').text() !== "" ||
            $('#phoneNumber-error').text() !== "" ||
            $('#email-error').text() !== "" ||
            $('#password-error').text() !== "" ||
            $('#confirmPassword-error').text() !== "" ||
            $('#role-error').text() !== ""
        );

        // Jika tidak ada error, kirim data form
        if (!hasError) {
            var dataForm = new FormData(document.getElementById('form-tambah'));

            $.ajax({
                url: '<?= site_url('UserManagementController/proses_tambah'); ?>',
                type: 'POST',
                data: dataForm,
                processData: false,
                contentType: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Tampilkan SweetAlert sukses dan redirect
                        showSweetAlert(data.status, data.message, '<?= site_url('UserManagementController'); ?>');
                    } else {
                        // Tampilkan SweetAlert error tanpa redirect
                        showSweetAlert(data.status, data.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Tampilkan SweetAlert untuk error AJAX
                    showSweetAlert('error', 'Terjadi kesalahan: ' + error);
                }
            });
        }
    });
});
</script>