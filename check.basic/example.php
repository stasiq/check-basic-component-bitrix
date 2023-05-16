<?$APPLICATION->IncludeComponent(
    "dev:check.basic",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "other",
        "IBLOCK_ID" => "1",
        "ELEMENT_COUNT" => "1",
        "ELEMENT_URL" => "#SITE_DIR#/#IBLOCK_CODE#/item/id/#ELEMENT_ID#/",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "grid",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
        "PAGER_SHOW_ALL" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
    ),
    false
);?>