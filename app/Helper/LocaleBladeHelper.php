<?php

function getDataKtMenuPlacementBottomValue()
{
    $current_lang = App::getLocale();

    if ($current_lang == 'ar') {
        $data_kt_menu_placement_bottom_value = 'bottom-start';
    } else {
        $data_kt_menu_placement_bottom_value = 'bottom-end';
    }
    return $data_kt_menu_placement_bottom_value;
}

function getDataKtMenuPlacementDirValue()
{
    $current_lang = App::getLocale();

    if ($current_lang == 'ar') {
        $data_kt_menu_placement_dir_value = 'left-start';
    } else {
        $data_kt_menu_placement_dir_value = 'right-start';
    }
    return $data_kt_menu_placement_dir_value;
}

