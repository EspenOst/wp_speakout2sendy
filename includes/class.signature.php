<?php

/**
 * Class for accessing and manipulating signature data in SpeakOut2sendy plugin for WordPress
 */
class no_speakout2sendy_signature
{
	public $id;
	public $petitions_id;
	public $first_name = '';
	public $last_name = '';
	public $email = '';
	public $optin = '';

	/**
	 * Retrieves a selection of signature records from the database
	 * 
	 * @param $petition_id (int) optional: the id of the petition whose signature should be retrieved
	 * @return (object) query results
	 */
	public function getList( $petition_id, $last_sync, $use_opt_in )
	{
		global $wpdb, $db_signatures;

		if($petition_id == null) return null;

		$last_sync_line = '';
		if($last_sync != null) $last_sync_line = "AND date > '" . $last_sync . "'";

		$use_opt_in_line = '';
		if($use_opt_in == 1) $use_opt_in_line = "AND Optin=1";

		$sql = "
			SELECT *
			FROM `$db_signatures`
			WHERE petitions_id = $petition_id
			$last_sync_line
			$use_opt_in_line
			ORDER BY id DESC 
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;

		
	}
}

?>