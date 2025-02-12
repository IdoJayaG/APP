<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branda Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
            font-size: 24px;
        }

        .label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #495057;
        }

        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #495057;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="submit"]:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        .required {
            color: #dc3545;
        }

        #keterangan-container {
            display: none;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Form Branda</h2>

        <form id="brandaForm">
            <label class="label">Tanggal <span class="required">*</span></label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label class="label">Batalyon <span class="required">*</span></label>
            <select id="batalyon" name="batalyon" required>
                <option value="">Pilih Batalyon</option>
                <option value="Batalyon A">Batalyon A</option>
                <option value="Batalyon B">Batalyon B</option>
                <option value="Batalyon C">Batalyon C</option>
            </select>

            <label class="label">Jumlah (Gabisa Diedit)</label>
            <input type="number" id="jumlah" name="jumlah" readonly>

            <label class="label">Kurang <span class="required">*</span></label>
            <input type="number" id="kurang" name="kurang" required>

            <label class="label">Hadir (Gabisa Diedit)</label>
            <input type="number" id="hadir" name="hadir" readonly>

            <div id="keterangan-container">
                <label class="label">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan..."></textarea>
            </div>

            <input type="submit" id="submitBtn" value="Submit" disabled>
        </form>
    </div>

    <script>
        const batalyonInput = document.getElementById('batalyon');
        const jumlahInput = document.getElementById('jumlah');
        const kurangInput = document.getElementById('kurang');
        const hadirInput = document.getElementById('hadir');
        const submitBtn = document.getElementById('submitBtn');
        const keteranganContainer = document.getElementById('keterangan-container');
        const tanggalInput = document.getElementById('tanggal');

        // Mapping jumlah untuk tiap batalyon
        const batalyonJumlah = {
            'Batalyon A': 50,
            'Batalyon B': 40,
            'Batalyon C': 30
        };

        // Ketika batalyon dipilih, isi jumlah sesuai batalyon
        batalyonInput.addEventListener('change', function() {
            const selectedBatalyon = batalyonInput.value;
            if (selectedBatalyon) {
                jumlahInput.value = batalyonJumlah[selectedBatalyon];
                hadirInput.value = batalyonJumlah[selectedBatalyon]; // Awalnya Hadir sama dengan Jumlah
            } else {
                jumlahInput.value = '';
                hadirInput.value = '';
            }
            validateForm(); // Periksa apakah semua input sudah terisi
        });

        // Ketika nilai kurang berubah, update hadir
        kurangInput.addEventListener('input', function() {
            const kurangValue = parseInt(kurangInput.value) || 0; // Default 0 jika kosong
            const jumlahValue = parseInt(jumlahInput.value) || 0;

            hadirInput.value = jumlahValue - kurangValue;

            // Tampilkan form keterangan jika kurang diisi
            if (kurangValue > 0) {
                keteranganContainer.style.display = 'block';
            } else {
                keteranganContainer.style.display = 'none';
            }
            validateForm();
        });

        // Fungsi untuk memeriksa apakah semua input yang wajib sudah diisi
        function validateForm() {
            if (tanggalInput.value !== '' && batalyonInput.value !== '' && kurangInput.value !== '') {
                submitBtn.disabled = false; // Aktifkan tombol submit jika semua input diisi
            } else {
                submitBtn.disabled = true;  // Nonaktifkan tombol submit jika ada yang kosong
            }
        }

        tanggalInput.addEventListener('input', validateForm);
    </script>

</body>
</html>
