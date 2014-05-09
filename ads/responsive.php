<?php
	
global $bn_adunit;
$bn_adunit++;
	
?>

<div class="ads-widget">			

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Responsive Unit -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-7958718753544197"
	     data-ad-slot="9732326709"
	     data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>	
	
</div>

<div class="adblock-notice" id="bn-adunit-<?=$bn_adunit?>">
	It looks like you're using an ad blocker! I really need the income to keep this site running.
	<br/>If you enjoy BlenderNation and you think it’s a valuable resource to the Blender community, please take a moment to <a href="http://www.blendernation.com/support-blendernation/" style="color:#fff;font-weight:bold;text-decoration:underline;">read how you can support BlenderNation</a>.

<!--
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="padding:0px;margin:0px;">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="ELYFS4VZXGQBQ">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" style="padding:0px;margin:5px 0 0 0;background:none;border:none;">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>	
-->
	
</div>

<script>
	if( window.canRunAds === undefined ){
		document.getElementById('bn-adunit-<?=$bn_adunit?>').style.display = 'block';
	}
</script>