<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}
?>
	<?if ($arResult['AUTH_SERVICES']):?>
		<?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
			'login',
			array(
				'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
				'AUTH_URL' => $arResult['CURR_URI']
	   		),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
		?>
		<hr class="bxe-light">
	<?endif?>


<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>