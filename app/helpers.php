<?php

function getMainMenuAsArray($lang): array
{
    $menus = config('telegram.menus')[$lang]['main_menu'];
    $arr = [];
    foreach ($menus as $menu) {
        foreach ($menu as $row) {
            $arr[$row['text']] = $row['action'];
        }
    }
    return $arr;
}
