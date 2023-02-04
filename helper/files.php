<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists("formatBytes")) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists("folder_exist")) {
    function folder_exist($folder)
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        if ($path !== false and is_dir($path)) {
            // Return canonicalized absolute pathname
            return $path;
        }

        // Path/folder does not exist
        return false;
    }
}

if (!function_exists('upload_file')) {
    function upload_file($request, $mime, $size, $target = null, $newname = null)
    {
        $response = ['status' => 0, 'link' => null];

        // cek jika ada request file
        if (!isset($_FILES[$request])) {
            $response['status'] = 'File upload tidak ditemukan';
            return $response;
        }

        $file = $_FILES[$request];
        // cek error
        if ($file['error'] !== 0) {
            $response['status'] = 'File error';
            return $response;
        }

        // cek mime
        if (!is_array($mime)) {
            if ($file['type'] !== $mime) {
                $response['status'] = 'File type tidak diizinkan';
                return $response;
            }
        } else {
            $allowed = false;
            foreach ($mime as $mim) {
                if ($file['type'] == $mim) {
                    $allowed = true;
                }
            }
            if (!$allowed) {
                $response['status'] = 'File type tidak diizinkan';
                return $response;
            }
        }

        // cek size
        if ($file['size'] > $size) {
            $response['status'] = 'File terlalu besar, jangan lebih besar dari ' . formatBytes($size);
            return $response;
        }

        // cek folder target
        if ($target !== null) {
            if (!folder_exist(fix_separator([get_config('STORAGE_DIR'), $target]))) {
                $response['status'] = 'Direktory tidak ditemukan';
                return $response;
            } else {
                $target_dir = fix_separator([get_config('STORAGE_DIR'), $target]);
            }
        } else {
            $target_dir = get_config('STORAGE_DIR');
        }

        if ($newname !== null) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $base_filename = $newname . "." . $extension;
        } else {
            $base_filename = $file['name'];
        }

        $target_file = fix_separator([$target_dir, $base_filename]);

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $response['status'] = '0';
            $response['link']   = $target_file;
        } else {
            $response['status'] = 'Gagal mengupload file!';
        }

        return $response;
    }
}
