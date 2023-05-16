<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<section id="iblock-random-items">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <article>
            <h4 <?= $arItem['BASIC_STATUS'] ? 'style="color: red"' : '' ?> ><?= $arItem['NAME']; ?></h4>
            <p>URL: <?= $arItem['URL'] ?></p>
        </article>
    <?php endforeach; ?>
</section>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>