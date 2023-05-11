<?php
//Пример вызова компонента
$APPLICATION->IncludeComponent(
    "dev:check.basic",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "other",
        "IBLOCK_ID" => "1",
        "ELEMENT_COUNT" => "4",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    ),
    false
);