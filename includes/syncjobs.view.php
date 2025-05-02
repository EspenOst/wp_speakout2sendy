<div class="wrap" id="no-speakout2sendy">

	<div id="icon-no-speakout2sendy" class="icon32"><br /></div>
	<h2><?php echo $page_title; ?> <a href="<?php echo $addnew_url; ?>" class="add-new-h2">Add New</a></h2>
	<?php if ( $message_update ) echo '<div id="message" class="updated"><p>' . $message_update . '</p></div>' ?>

	<div class="tablenav">
		<ul class='subsubsub'>
			<li class='table-label'>All Sendylists <span class="count">(<?php echo $count; ?>)</span></li>
		</ul>
	</div>

	<table class="widefat">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Speakout petition Id</th>
				<th>Sendylist id</th>
				<th>Use OptIn</th>
				<th>last_sync</th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
			<th>ID</th>
				<th>Name</th>
				<th>Speakout petition Id</th>
				<th>Sendylist id</th>
				<th>Use OptIn</th>
				<th>last_sync</th>
				<th></th>
			</tr>
		</tfoot>
		<tbody>
		<?php if ( $count == 0 ) echo '<tr><td colspan="4"> No Syncjobs found.</td></tr>'; ?>
		<?php foreach ( $syncjobs as $syncjob ) : ?>
			<?php $edit_url    = esc_url( wp_nonce_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_addnewsyncjob&action=edit&id=' . $syncjob->id, 'no_speakout2sendy-edit_syncjob' . $syncjob->id ) ); ?>
			<?php $delete_url  = esc_url( wp_nonce_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_top&action=delete&id=' . $syncjob->id, 'no_speakout2sendy-delete_syncjob' . $syncjob->id ) ); ?>
			<?php $syncjob_url = esc_url( wp_nonce_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_top&action=run&id=' . $syncjob->id, 'no_speakout2sendy-run_syncjob' . $syncjob->id) ); ?>
			<tr class="no-speakout2sendy-tablerow">
				<td>
					<a class="row-title" href="<?php echo $edit_url; ?>"><?php echo stripslashes( esc_html( $syncjob->id ) ); ?></a>
				</td>
				<td>
					<a class="row-title" href="<?php echo $edit_url; ?>"><?php echo stripslashes( esc_html( $syncjob->name ) ); ?></a>
					<div class="row-actions">
						<span class="edit"><a href="<?php echo $edit_url; ?>">Edit</a> | </span>
						<span><a href="<?php echo $delete_url; ?>" class="no-speakout2sendy-delete-petition">Delete</a></span>
					</div>
				</td>
				<td><?php echo $syncjob->wp_speakout_petitions_id ?></td>
				<td><?php echo $syncjob->sendylist_id ?></td>
				<td><?php echo ($syncjob->use_opt_in == 1 ? 'Yes' : 'No') ?></td>
				<td><?php echo $syncjob->last_sync ?></td>
				<td class="no-speakout2sendy-right" style="vertical-align: middle"><a class="button" href="<?php echo $syncjob_url; ?>">Run syncjob</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div id="no-speakout2sendy-delete-confirmation" class="no-speakout2sendy-hidden">Delete this syncjob permanently?</div>

</div>