<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule('iblock')) {
    ShowError('Модуль «Информационные блоки» не установлен');
    return;
}

if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 3600;
}

if ($this->StartResultCache(false, rand(1, 4))) {

    $arSelect = array(
        'ID',
        'CODE',
        'IBLOCK_ID',
        'NAME',
        'PREVIEW_PICTURE',
        'DETAIL_PAGE_URL',
        'PREVIEW_TEXT',
        'PREVIEW_TEXT_TYPE',
        'URL'
    );

    $arFilter = array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'IBLOCK_ACTIVE' => 'Y',
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y'
    );

    $arSort = array(
        'RAND' => 'ASC',
    );

    $arNavParams = null;
    $arNavigation = false;
    $arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
    if ($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER']) {
        $arNavParams = array(
            'nPageSize' => $arParams['ELEMENT_COUNT'], // количество элементов на странице
            'bShowAll' => $arParams['PAGER_SHOW_ALL'], // показывать ссылку «Все элементы»?
            "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],

        );
        $arNavigation = CDBResult::GetNavParams($arNavParams);
    }

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        $arNavParams,
        $arSelect
    );

    $arResult['ITEMS'] = array();
    while ($arItem = $rsElements->GetNext()) {

        $res = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array("sort" => "asc"), array("CODE" => "URL"));
        while ($ob = $res->GetNext()) {
            $arItem['URL'] = $ob['VALUE'];
            $headers = get_headers($ob['VALUE'], 1);

            if (isset($headers['WWW-Authenticate'])) {
                $arItem['BASIC_STATUS'] = true;
            } else {
                $arItem['BASIC_STATUS'] = false;
            }
        }
        $arResult['ITEMS'][] = $arItem;
    }

    $arResult['NAV_STRING'] = $rsElements->GetPageNavString(
        $arParams['PAGER_TITLE'],
        $arParams['PAGER_TEMPLATE'],
        $arParams['PAGER_SHOW_ALWAYS'],
        $this
    );

    if (empty($arResult['ITEMS'])) {
        $this->AbortResultCache();
    }

    $this->IncludeComponentTemplate();
}
