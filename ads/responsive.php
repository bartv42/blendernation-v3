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
	Oh no! It looks like you're using an ad blocker. I really need an income to keep this site running, so please enable advertisements on BlenderNation, or <a href="test">read about other ways to support me
	</a>. Everything helps, thanks!
</div>

<script>
	if( window.canRunAds === undefined ){
		document.getElementById('bn-adunit-<?=$bn_adunit?>').style.display = 'block';
	}
</script>