<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if (!$length) {
        return true;
    }
    return substr($haystack, -$length) === $needle;
}

function find_array($neddle, $array)
{
    foreach ($array as $key => $val) {
        if (strtolower(trim($neddle)) === strtolower(trim($val))) {
            return $key;
        }
    }
    return null;
}

if (!function_exists("buat_singkatan")) {
    function buat_singkatan($str)
    {
        $bidang_studi = [
            'Agribisnis Pengolahan Hasil Pertanian',
            'Akuntansi',
            'Antropologi',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Bahasa Jerman',
            'Bahasa Perancis',
            'Bimbingan dan Konseling',
            'Biologi',
            'Ekonomi',
            'Fisika',
            'Geografi',
            'Guru Pendidikan Anak Usia Dini',
            'Guru Sekolah Dasar',
            'Kimia',
            'Matematika',
            'Pendidikan Jasmani, Olahraga, dan Kesehatan',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Perhotelan dan Jasa Pariwisata',
            'Perikanan',
            'Sejarah',
            'Seni Musik',
            'Seni Rupa',
            'Seni Tari',
            'Tata Boga',
            'Tata Busana',
            'Tata Niaga',
            'Tata Rias',
            'Teknik Bangunan',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Otomotif'
        ];

        $singkatan = [
            'APHP',
            'AKN',
            'ANTRO',
            'BIND',
            'BING',
            'BJER',
            'BPER',
            'BK',
            'BIO',
            'EKO',
            'FIS',
            'GEO',
            'GPAUD',
            'GSD',
            'KIM',
            'MAT',
            'PENJASKES',
            'PPKN',
            'PJP',
            'PERKN',
            'SJR',
            'S-MUS',
            'S-RUP',
            'S-TAR',
            'T-BOG',
            'T-BUS',
            'T-NIA',
            'T-RIA',
            'T-BGN',
            'T-ELK',
            'T-MSN',
            'T-OTO'
        ];

        $str = trim($str);
        if (endsWith($str, ")")) {
            $pos_kurung_buka = strpos($str, "(");
            $singkatan = substr($str, $pos_kurung_buka + 1, (strlen($str) - $pos_kurung_buka - 2));
        } else {
            $sing_index = find_array($str, $bidang_studi);
            if ($sing_index != null) {
                $singkatan = $singkatan[$sing_index];
            } else {
                $singkatan = "";
                if (str_word_count($str) > 1) {
                    $words = str_word_count($str, 1);
                    foreach ($words as $kata) {
                        if (strtolower($kata) != "dan") {
                            $singkatan .= strtoupper(substr($kata, 0, 1));
                        }
                    }
                } else {
                    $singkatan = $str;
                }
            }
        }

        return $singkatan;
    }
}
