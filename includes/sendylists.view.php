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
				<th>SendyDomain</th>
				<th>ApiKey</th>
				<th>List</th>
			</tr>
		</thead>
		<tbody>
		<?php if ( $count == 0 ) echo '<tr><td colspan="5"> No Sendylists found.</td></tr>'; ?>
		<?php foreach ( $sendylists as $sendylist ) : ?>
			<?php $edit_url       = esc_url( wp_nonce_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_addnewsendylist&action=edit&id=' . $sendylist->id, 'no_speakout2sendy-edit_sendylist' . $sendylist->id ) ); ?>
			<?php $delete_url     = esc_url( wp_nonce_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_sendylists&action=delete&id=' . $sendylist->id, 'no_speakout2sendy-delete_sendylist' . $sendylist->id ) ); ?>
			<tr class="no-speakout2sendy-tablerow">
				<td>
					<a class="row-title" href="<?php echo $edit_url; ?>"><?php echo stripslashes( esc_html( $sendylist->id ) ); ?></a>
				</td>
				<td>
					<a class="row-title" href="<?php echo $edit_url; ?>"><?php echo stripslashes( esc_html( $sendylist->name ) ); ?></a>
					<div class="row-actions">
						<span class="edit"><a href="<?php echo $edit_url; ?>">Edit</a> | </span>
						<span><a href="<?php echo $delete_url; ?>" class="no-speakout2sendy-delete-petition">Delete</a></span>
					</div>
				</td>
				<td><?php echo $sendylist->sendyurl ?></td>
				<td><?php echo $sendylist->apikey ?></td>
				<td><?php echo $sendylist->list ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>SendyDomain</th>
				<th>ApiKey</th>
				<th>List</th>
			</tr>
		</tfoot>
	</table>
	<div id="no-speakout2sendy-delete-confirmation" class="no-speakout2sendy-hidden">Delete this sendylist permanently?</div>

</div>