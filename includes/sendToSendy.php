<?php

class no_speakout2sendy_sendToSendy
{

	function send($sendylist, $signature) {

		$baseUrl = 'https://sendy.dyrsfrihet.no/subscribe';

		$body = array(
			'name'    => sanitize_text_field( $signature->first_name . ' ' .  $signature->last_name ),
			'email'   => sanitize_email( $signature->email),
			'api_key' => sanitize_text_field( $sendylist->apikey ),
			'list'    => sanitize_text_field( $sendylist->list ),
			'gdpr'    => sanitize_text_field("true"),
		);

		$args = array(
			'body' => $body,
		);

		$response = wp_remote_post( $baseUrl, $args );
	}
}

?>