<?php
    function bobotNilai($nilai){
        if ($nilai >= 80) return 4.0;
        elseif ($nilai >= 70) return 3.0;
        elseif ($nilai >= 60) return 2.0;
        elseif ($nilai >= 50) return 1.0;
        else return 0.0;
    }

    function getGrade ($nilai) {
        if ($nilai >= 80) return 'A';
        elseif ($nilai >= 70) return 'B';
        elseif ($nilai >= 60) return 'C';
        elseif ($nilai >= 50) return 'D';
        else return 'E';
    }

    $matkul = [
        'Dasar Manajemen dan Bisnis',
        'Logika Matematika',
        'Arsitektur dan Organisasi Komputer',
        'Pemrograman Web I',
        'Paket Program Aplikasi',
        'Pengantar Teknologi Informasi',
        'Algoritma Pemrograman',
        'Bahasa Inggris I'
    ];

    $hasil = [];
    $totalMutu = 0;
    $nama;
    $nim;

    if(isset($_POST['kirim'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $nilaiArray = $_POST['nilai'];
        
        foreach($nilaiArray as $matKe => $nilai) {
            $mutu = bobotNilai($nilai);
            $grade = getGrade($nilai);
            $totalMutu += $mutu;
            
            $hasil[] = [
                'matkul' => $matkul[$matKe],
                'nilai' => $nilai,
                'grade' => $grade,
                'mutu' => $mutu
            ];
        }
        
        $ipk = $totalMutu / count($matkul);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            --color: rgb(100, 23, 255);
        }
        
        input[type="number"]::-webkit-inner-spin-button {
            display: none;
        }
        
        body {
            /* background-image: linear-gradient(to bottom,rgb(100, 23, 255), #8e2de2); */
            background-color: var(--color);
        }

        .body {
            margin-top: -10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .head {
            display: flex;
            margin-top: 45px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        header {
            margin-top: 20px;
            text-align: center;
        }

        /* header h2 {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            margin-inline: auto;
            width: fit-content;
        } */
        
        header p {
            /* position: absolute;
            top: 55px;
            left: 0;
            right: 0;
            margin-inline: auto; */
            margin: 0 auto  ;
            text-align: center;
            width: fit-content;
            background-color: #fff;
            color: var(--color);
            padding: 0 3px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        p.ket {
            margin-top: 50px;
            margin-bottom: 10px;
            text-align: center;
        }
        
        b {
            background-color: #fff;
            color: var(--color);
            padding: 0 3px;
            border-radius: 5px;
        }
        
        .input-group {
            position: relative;
            margin: 20px 0;
        }
        
        .input-group label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            padding: 0 5px;
            pointer-events: none;
            transition: .5s;
            background-color: var(--color);
            
        }

        .input-group input {
            width: 320px;
            height: 40px;
            font-size: 16px;
            color: #fff;
            padding: 0 10px;
            background: transparent;
            border: 1.2px solid #fff;
            outline: none;
            border-radius: 5px;
        }

        .input-group input:focus~label,
        .input-group input:valid~label {
            top: 0;
            font-size: 12px;
            background-color: var(--color);
        }

        button {
            font-family: inherit;
            display: inline-block;
            width: 50%;
            height: 2.6em;
            line-height: 2.5em;
            margin: 20px;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            border: 2px solid var(--color);
            transition: color 0.5s;
            z-index: 1;
            font-size: 17px;
            border-radius: 6px;
            font-weight: 600;
            color: var(--color);
            margin-left: 75px;
        }
        
        button:before {
            content: "";
            position: absolute;
            z-index: -1;
            background: var(--color);
            height: 150px;
            width: 200px;
            border-radius: 50%;
        }
        
        button:hover {
            color: #fff;
        }

        button:before {
            top: 100%;
            left: 100%;
            transition: all 0.7s;
        }

        button:hover:before {
            top: -30px;
            left: -30px;
        }
        
        button:active:before {
            background: var(--color);
            transition: background 0s;
        }
        
        .output h2 {
            margin-top: 100px;
            text-align: center;
        }
    
        .table-out {
            margin-top: 50px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .table-out th, .table-out td {
            padding: 10px;
            text-align: left;
            border: 1px solid #fff;
        }
        
        .table-out {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <title>Kalkulator Nilai Mahasigma</title></head>
</head>
<body> 
     <!-- Judul Brooo -->
    <header>
        <h2>Kalkulator IPK Mahasigma</h2>
        <p>Khusus S1 Teknik Informatika</p>
    </header>
    
    <!-- Inputan Identitas -->
    <form action="?scroll=true" method="POST" autocomplete="off">
        <div class="head">
            <div class="input-group">
                <input type="text" name="nama" required>
                <label for="">Nama</label>
            </div>

            <div class="input-group">
                <input type="number" name="nim" required>
                <label for="">NIM</label>
            </div>
        </div>
    
        <!-- Inputan Nilai dengan Looping Foreach -->
        <div class="body">
            <p class="ket">Masukan Nilai Mata Kuliah yang valid <b>0 - 100</b></p>
            <div class="form-container">
                <?php foreach($matkul as $matKe => $mk): ?>
                    <div class="input-group">
                        <input type="number" name="nilai[]" required min="0" max="100">
                        <label for=""><?php echo $mk; ?></label>
                    </div>
                <?php endforeach; ?>
                
                <!-- Tombol OverPower! -->
                <button type="submit" name="kirim">KIRIM CUY!</button>
            </div>
        </div>
    </form>

    <?php if(isset($_POST['kirim'])): ?>
        <div id="scroll-target"></div>
    <?php endif; ?>

    <!-- Ini Bagian Outputnya -->
    <div class="output">
        <?php if(isset($_POST['kirim'])): ?>
            <style>
                body {
                    height: 1700px;
                }
            </style>

            <h2 id="kesini">Inilah Hasil Kalkulasi Nilamu</h2>
            <div class="table-out">
                <h3>Nama: <?php echo $nama; ?></h3>
                <h3>NIM: <?php echo $nim; ?></h3>
            </div>
            
            <table class="table-out">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Nilai Angka</th>
                    <th>Grade</th>
                    <th>Bobot</th>
                </tr>

                <?php foreach($hasil as $out): ?>
                <tr>
                    <td><?php echo $out['matkul']; ?></td>
                    <td><?php echo $out['nilai']; ?></td>
                    <td><?php echo $out['grade']; ?></td>
                    <td><?php echo number_format($out['mutu'], 1); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            
            <div class="table-out">
                <h3><u>IPK: <?php echo number_format($ipk, 2); ?></u></h3>
            </div>
        <?php endif; ?>
    </div>


    <!-- Sedikit JS -->
    <script>
        console.log('JS Aktif Broo');
        console.log('Result element: ', document.getElementById('kesini'));
        
        document.addEventListener('DOMContentLoaded', function() {
            if (new URLSearchParams(window.location.search).has('scroll')) {
                console.log('Parameter Scroll nya Lagi Jalan');
                
                setTimeout(function() {
                    const resultElement = document.getElementById('kesini');
                    console.log('Elemen target:', resultElement);
                    
                    if (resultElement) {
                        const offsetPosition = resultElement.offsetTop - 50;
                        console.log('Posisi scroll:', offsetPosition);
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }, 500);
            }
        });
    </script>

</body>
</html>
