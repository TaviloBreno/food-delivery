<?php

if (!function_exists('asset_version')) {
    function asset_version($path)
    {
        $fullPath = FCPATH . $path;
        if (file_exists($fullPath)) {
            return site_url($path) . '?v=' . filemtime($fullPath);
        }
        return site_url($path);
    }
}
