<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    'NAME' => 'Проверка basic',
    'DESCRIPTION' => 'Проверка присутствия basic авторизации на домене',
    'ICON' => '/images/icon.gif',
    'CACHE_PATH' => 'Y',
    'SORT' => 40,
    'COMPLEX' => 'N',
    'PATH' => array(
        'ID' => 'other_components',
        'NAME' => 'Прочие компоненты',
    )
);
