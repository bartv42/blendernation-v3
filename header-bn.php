<?php $arrHeader = bn_get_header(); ?>


<div id="header">
	<a href="<?=$arrHeader['link'] ?>" rel="bookmark">

		<img src="<?=$arrHeader['img_src'] ?>" width="1078" alt=""/>
												
		<? if( $arrHeader['no_link'] != 1) { ?>	
			<div id="header_name">
				<?=$arrHeader['description']?>
				&nbsp;
				<span class="comments"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<?=$arrHeader['comment_count']?></span>
			</div>
		<? } ?>
	</a>
</div>