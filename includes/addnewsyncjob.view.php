<style>
    label{margin:10px 0 5px 0;}
</style>

<div class="wrap" id="no-speakout2sendy">
	<div id="icon-no-speakout2sendy" class="icon32"><br /></div>
	<h2><?php echo $page_title; ?></h2>
	<?php if ( $message_update ) echo '<div id="message" class="updated"><p>' . $message_update . '</p></div>'; ?>
	<div id="message" class="error no-speakout2sendy-error-msg"><p> Error: Please correct the highlighted fields.</p></div>

	<form name="no-speakout2sendy-edit-syncjob" id="no-speakout2sendy-edit-syncjob" method="post" action="">
		<?php wp_nonce_field( $nonce ); ?>
		<input type="hidden" name="action" value="<?php echo $action; ?>" />
		<?php if ( $syncjob->id ) echo ('<input type="hidden" name="id" value="' . esc_attr( $syncjob->id ) . '" />'); ?>
		<input type="hidden" name="action" value="<?php echo $action; ?>" />
		
		<div id="post-body-content">
			<div class="postbox">		
				<div class="no-speakout2sendy-syncjob-content">
					<div class="no-speakout2sendy-headers">
						<label for="name">Name <span class='normalText'>'Internal name to rember the Syncjob by</span></label> 
						<input name="name" id="name" value="<?php echo esc_attr( $syncjob->name ); ?>" size="40" maxlength="300" type="text" />

						<label for="wp_speakout_petitions_id">Speakout petition id <span class='normalText'>Speakout Petition Id</span></label> 
						<select id="wp_speakout_petitions_id" name="wp_speakout_petitions_id">
							<?php foreach( $petitions_list as $petition ) :
								$selected = $petition->id == $syncjob->wp_speakout_petitions_id ? "SELECTED" : ""; 
							?>
								<option value="<?php echo $petition->id; ?>" <?php echo $selected; ?>><?php echo stripslashes( $petition->title ); ?></option>
							<?php endforeach; ?>
						</select>

						<label for="sendylist_id">Sendylist Id <span class='normalText'>Sendylist id for the sendy mailing list</span></label>
						<select id="sendylist_id" name="sendylist_id">
							<?php foreach( $sendylist_list as $sendylist ) :
								$selected = $sendylist->id == $syncjob->sendylist_id ? "SELECTED" : ""; 
							?>
								<option value="<?php echo $sendylist->id; ?>" <?php echo $selected; ?>><?php echo stripslashes( $sendylist->name ); ?></option>
							<?php endforeach; ?>
						</select>

						<div class="no-speakout2sendy-checkbox">
							<input type="checkbox" name="use_opt_in" id="use_opt_in"/>
							<label for="use_opt_in" class="no-speakout2sendy-inline">Only sync mail address if user has select to opt in</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="submit" name="Submit" id="no_speakout2sendy_syncjob_submit" value="<?php echo esc_attr( $button_text ); ?>" class="button-primary" />
	</form>

</div>

