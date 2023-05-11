<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule('iblock')) {
    ShowError('Модуль «Информационные блоки» не установлен');
    return;
}

if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 3600;
}

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

$arLimit = array(
    'nTopCount' => $arParams['ELEMENT_COUNT']
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    $arLimit,
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

if (empty($arResult['ITEMS'])) {
    $this->AbortResultCache();
}

$this->IncludeComponentTemplate();
