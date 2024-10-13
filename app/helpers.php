<?php
/**
 * @param $icon
 * @return string
 */
if(!function_exists('loadSvg')) {
    function loadSvg($icon) {
        $fileUrl = file_get_contents(public_path("/assets/svgs/{$icon}.svg"));
        return $fileUrl ?? '';
    }
}

/**
 * @param $title
 * @param $color
 * @return string
 */
if(!function_exists('getBadge')) {
    function getBadge($title, $color) {
        return '<span class="btn btn-'.$color.' btn-sm text-xs">' . $title . '</span>';
    }
}