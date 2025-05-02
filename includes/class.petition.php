<?php

/**
 * Class for accessing and manipulating petition data in SpeakOut2sendy plugin for WordPress CMS
 */
class no_speakout2sendy_Petition
{

	public $id; 
	public $title;

	/**
	 * Counts the number of petitions in the database
	 * 
	 * @return (int) the number of petitions in the database
	 */
	public function count()
	{
		global $wpdb, $db_petitions;

		$sql = "
			SELECT `id`
			FROM `$db_petitions`
		";
		$query_results = $wpdb->get_results( $sql );

		return count( $query_results );
	}


	/**
	 * Retrieves a list of petitions to populate select box navigation
	 * Only queries the info needed to populate select box at head of Signatures view
	 *
	 * @return (object) query results
	 */
	public function quicklist()
	{
		global $wpdb, $db_petitions;

		$sql = "
			SELECT id, title
			FROM `$db_petitions`
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;
	}


	//********************************************************************************
	//* Private
	//********************************************************************************


}

?>