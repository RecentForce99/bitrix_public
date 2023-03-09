<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 */

CUtil::InitJSCore(array("popup"));

$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}

$hiddens = "";
foreach($arPost as $key => $value)
{
	if(!preg_match("|OPENID_IDENTITY|", $key))
	{
		$hiddens .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />'."\n";
	}
}
?>
<script type="text/javascript">
function BxSocServPopup(id)
{
	var content = BX("bx_socserv_form_"+id);
	if(content)
	{
		var popup = BX.PopupWindowManager.create("socServPopup"+id, BX("bx_socserv_icon_"+id), {
			autoHide: true,
			closeByEsc: true,
			angle: {offset: 24},
			content: content,
			offsetTop: 3
		});

		popup.show();

		var input = BX.findChild(content, {'tag':'input', 'attribute':{'type':'text'}}, true);
		if(input)
		{
			input.focus();
		}

		var button = BX.findChild(content, {'tag':'input', 'attribute':{'type':'submit'}}, true);
		if(button)
		{
			button.className = 'btn btn-primary';
		}
	}
}
</script>
<style>
    .img-socials
    {
        width: 65% ;
        height: auto;
        display: block;
        position: relative;
    }
    .social-marg
    {
        margin-left: 0.3em;
        margin-right: 0.3em;
    }
</style>
    <ul style="display: flex; justify-content: center">
        <?
        foreach($arAuthServices as $service):
            $onclick = ($service["ONCLICK"] <> ''? $service["ONCLICK"] : "BxSocServPopup('".$service["ID"]."')");
            ?>

            <li class="authorization-social__item">
                <a id="bx_socserv_icon_<?=$service["ID"]?>" class="social-marg social social_google" href="javascript:void(0)" onclick="<?=\Bitrix\Main\Text\HtmlFilter::encode($onclick)?>" title="<?=\Bitrix\Main\Text\HtmlFilter::encode($service["NAME"])?>">
                    <img class="img-socials" src="<?= SITE_TEMPLATE_PATH ?>/img/<?=$service["ICON"]?>.png" width="40" alt="">
                </a>

                <?if($service["ONCLICK"] == '' && $service["FORM_HTML"] <> ''):?>
                    <div id="bx_socserv_form_<?=$service["ID"]?>" class="bx-authform-social-popup">
                        <form action="<?=$arParams["AUTH_URL"]?>" method="post">
                            <?=$service["FORM_HTML"]?>
                            <?=$hiddens?>
                            <input type="hidden" name="auth_service_id" value="<?=$service["ID"]?>" />
                        </form>
                    </div>
                <?endif?>
            </li>
        <?
        endforeach;
        ?>

    </ul>
