<?php
// Funciones útiles
function format_size($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

function get_file_icon($type) {
    $icons = [
        'image' => 'fa-file-image',
        'audio' => 'fa-file-audio',
        'video' => 'fa-file-video',
        'application/pdf' => 'fa-file-pdf',
        'application/msword' => 'fa-file-word',
        'application/vnd.ms-excel' => 'fa-file-excel',
        'application/zip' => 'fa-file-archive',
        'text/plain' => 'fa-file-alt',
        'text/html' => 'fa-file-code',
        'default' => 'fa-file'
    ];
    
    foreach ($icons as $key => $icon) {
        if (strpos($type, $key) !== false) {
            return $icon;
        }
    }
    
    return $icons['default'];
}
?>