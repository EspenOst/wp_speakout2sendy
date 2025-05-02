<style>
    label{margin:10px 0 5px 0;}
</style>

<div class="wrap" id="no-speakout2sendy">
	<div id="icon-no-speakout2sendy" class="icon32"><br /></div>
	<h2><?php echo $page_title; ?></h2>
	<?php if ( $message_update ) echo '<div id="message" class="updated"><p>' . $message_update . '</p></div>'; ?>
	<div id="message" class="error no-speakout2sendy-error-msg"><p> Error: Please correct the highlighted fields.</p></div>

	<form name="no-speakout2sendy-edit-sendylist" id="no-speakout2sendy-edit-sendylist" method="post" action="">
		<?php wp_nonce_field( $nonce ); ?>
		<input type="hidden" name="action" value="<?php echo $action; ?>" />
		<?php if ( $sendylist->id ) echo '<input type="hidden" name="id" value="' . esc_attr( $sendylist->id ) . '" />'; ?>
		<input type="hidden" name="action" value="<?php echo $action; ?>" />
		
		<div id="post-body-content">
			<div class="postbox">		
				<div class="no-speakout2sendy-sendylist-content">
					<div class="no-speakout2sendy-headers">
						<label for="name">Name <span class='normalText'>'Internal name to rember the Sendy list by</span></label> 
						<input name="name" id="name" value="<?php echo esc_attr( $sendylist->name ); ?>" size="40" maxlength="300" type="text" />

						<label for="apikey">Api key <span class='normalText'>apikey for the sendy account</span></label> 
						<input name="apikey" id="apikey" value="<?php echo esc_attr( $sendylist->apikey ); ?>" size="40" maxlength="300" type="text" />
						
						<label for="list">List id <span class='normalText'>list id for the sendy mailing list</span></label>
						<input name="list" id="list" value="<?php echo stripslashes( esc_attr( $sendylist->list ) ); ?>" size="40" maxlength="80" type="text" />
					</div>
				</div>
			</div>
		</div>
		<input type="submit" name="Submit" id="no_speakout2sendy_sendylist_submit" value="<?php echo esc_attr( $button_text ); ?>" class="button-primary" />
	</form>
</div>