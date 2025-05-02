<?php

/**
 * Class for accessing and manipulating syncjob data in SpeakOut2sendy plugin for WordPress CMS
 */
class no_speakout2sendy_syncjob
{
	public $id; 
	public $name;
	public $wp_speakout_petitions_id;
	public $sendylist_id;
	public $use_opt_in=0;
	public $last_sync;
	public $created_date;

	/**
	 * Retrieves a selection of sendylists records from the database
	 * 
	 * @return (object) query results
	 */
	public function all()
	{
		global $wpdb, $db_syncjobs;

		// query syncjobs
		$sql = "
			SELECT $db_syncjobs.id, $db_syncjobs.name, $db_syncjobs.wp_speakout_petitions_id, $db_syncjobs.sendylist_id, $db_syncjobs.use_opt_in, $db_syncjobs.last_sync , $db_syncjobs.created_date
			FROM $db_syncjobs
			ORDER BY `id` DESC
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;
	}

	/**
	 * Counts the number of syncjobs in the database
	 * 
	 * @return (int) the number of syncjobs in the database
	 */
	public function count()
	{
		global $wpdb, $db_syncjobs;

		$sql = "
			SELECT `id`
			FROM `$db_syncjobs`
		";
		$query_results = $wpdb->get_results( $sql );

		return count( $query_results );
	}

	/**
	 * Creates a new syncjob record in the database
	 */
	public function create()
	{
		global $wpdb, $db_syncjobs;

		$data = array(
			'name'                     => $this->name,
			'wp_speakout_petitions_id' => $this->wp_speakout_petitions_id,
			'sendylist_id'             => $this->sendylist_id,
			'use_opt_in'               => $this->use_opt_in,
			'last_sync'                => $this->last_sync,
			'created_date'             => $this->created_date
		);

		$format = array( '%s', '%d', '%d', '%d', '%s', '%s');
			
		$wpdb->insert( $db_syncjobs, $data, $format );

		// grab the id of the record we just added to the database
		$this->id = $wpdb->insert_id;

	}

	/**
	 * Deletes a syncjob from the database
	 *
	 * @param $id (int) value of the syncjob's 'id' field in the database
	 */
	public function delete( $id )
	{
		global $wpdb, $db_syncjobs;

		// delete syncjob from the db
		$sql = "
			DELETE FROM `$db_syncjobs`
			WHERE `id` = '%d'
		";
		$wpdb->query( $wpdb->prepare( $sql, $id ) );
	}


	/**
	 * Populates the properties of this object with posted form values
	 * id
	 * name
	 * wp_speakout_petitions_id
	 * sendylist_id
	 * use_opt_in
	 * last_sync
	 */
	public function populate_from_post()
	{
		// Meta info
		if ( isset( $_POST['id'] ) ) {
			$this->id = $_POST['id'];
		}
		// name
		if ( isset( $_POST['name'] ) && $_POST['name'] != '' ) {
			$this->name = $_POST['name'];
		}
		// wp_speakout_petitions_id
		$this->wp_speakout_petitions_id = strip_tags( $_POST['wp_speakout_petitions_id'] );
		// sendylist_id
		$this->sendylist_id = strip_tags( $_POST['sendylist_id'] );
		// use_opt_in
		if ( isset( $_POST['use_opt_in'] ) ) {$this->use_opt_in = 1;}
		// last_sync
		if ( isset( $_POST['last_sync'] ) && $_POST['last_sync'] != '' ) {
			$this->last_sync = $_POST['last_sync'];
		} else {
			$this->last_sync = null;
		}
		// created_date (set to now)
		$this->created_date = current_time( 'mysql', 0 );
	}

	/**
	 * Retrieves a list of syncjobs to populate select box navigation
	 * Only queries the info needed to populate select box 
	 *
	 * @return (object) query results
	 */
	public function quicklist()
	{
		global $wpdb, $db_syncjobs;

		$sql = "
			SELECT id, name
			FROM `$db_syncjobs`
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;
	}

	public function get($id)
	{
		global $wpdb, $db_syncjobs;

		$sql = "
			SELECT id, name, wp_speakout_petitions_id, sendylist_id, use_opt_in, last_sync, created_date
			FROM $db_syncjobs
			WHERE id = $id
		";
		$syncjob = $wpdb->get_results( $sql );

		if(count($syncjob) == 1) return $syncjob[0];
		return null;
	}

	public function setLastSync($id, $current_time)
	{
		global $wpdb, $db_syncjobs;

		$data = array(
			'last_sync' => $current_time
		);
		$where = array( 'id' => $id );

		$wpdb->update( $db_syncjobs, $data, $where );
	}

	/**
	 * Reads a syncjob record from the database
	 * 
	 * @param (int) $id value of the syncjob's 'id' field in the database
	 * @return (bool) true if query returns a result, false if no results found
	 */
	public function retrieve( $id )
	{
		global $wpdb, $db_syncjobs;

		$sql = "
			SELECT $db_syncjobs.*
			FROM $db_syncjobs
			WHERE $db_syncjobs.id = $id
		";
		$syncjob = $wpdb->get_row( $sql );
		
		$rowcount = $wpdb->get_var( $sql );
		if ( $rowcount > 0 ) {
			$this->_populate_from_query( $syncjob );
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Updates an existing syncjob record in the database
	 * 
	 * @param (int) $id value of the syncjob's 'id' field in the database
	 */
	public function update( $id )
	{
		global $wpdb, $db_syncjobs;

		$data = array(
			'name'                     => $this->name,
			'wp_speakout_petitions_id' => $this->wp_speakout_petitions_id,
			'sendylist_id'             => $this->sendylist_id,
			'use_opt_in'               => $this->use_opt_in
		);
		$where = array( 'id' => $id );

		$wpdb->update( $db_syncjobs, $data, $where );
	}

	//********************************************************************************
	//* Private
	//********************************************************************************

	/**
	 * Populates the parameters of this object with values from the database 
	 * 
	 * @param (object) $syncjob database query results
	 */
	private function _populate_from_query( $syncjob )
	{
		$this->id                       = $syncjob->id;
		$this->name                     = $syncjob->name;
		$this->wp_speakout_petitions_id = $syncjob->wp_speakout_petitions_id;
		$this->sendylist_id             = $syncjob->sendylist_id;
		$this->use_opt_in               = $syncjob->use_opt_in;
		$this->created_date             = $syncjob->created_date;
		$this->last_sync                = $syncjob->last_sync;
	}
}

?>