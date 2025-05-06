<?php

/**
 * Class for accessing and manipulating sendylist data in SpeakOut2sendy plugin for WordPress CMS
 */
class no_speakout2sendy_sendylist
{
	public $id; 
	public $name;
	public $sendyurl;
	public $apikey;
	public $list;
	public $created_date;

	/**
	 * Retrieves a selection of sendylists records from the database
	 * 
	 * @return (object) query results
	 */
	public function all()
	{
		global $wpdb, $db_sendylists;

		// query sendylists 
		$sql = "
			SELECT $db_sendylists.id, 
				$db_sendylists.name, 
				$db_sendylists.sendyurl, 
				$db_sendylists.apikey, 
				$db_sendylists.list, 
				$db_sendylists.created_date
			FROM $db_sendylists
			ORDER BY `id` DESC
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;
	}

	/**
	 * Counts the number of sendylists in the database
	 * 
	 * @return (int) the number of sendylists in the database
	 */
	public function count()
	{
		global $wpdb, $db_sendylists;

		$sql = "
			SELECT `id`
			FROM `$db_sendylists`
		";
		$query_results = $wpdb->get_results( $sql );

		return count( $query_results );
	}

	/**
	 * Creates a new sendylist record in the database
	 */
	public function create()
	{
		global $wpdb, $db_sendylists;

		$data = array(
			'name'         => $this->name,
			'sendyurl'     => $this->sendyurl,
			'apikey'       => $this->apikey,
			'list'         => $this->list,
			'created_date' => $this->created_date
		);

			$format = array( '%s', '%s', '%s', '%s', '%s');
			
		$wpdb->insert( $db_sendylists, $data, $format );

		// grab the id of the record we just added to the database
		$this->id = $wpdb->insert_id;

	}

	/**
	 * Deletes a sendylist from the database
	 *
	 * @param $id (int) value of the sendylist's 'id' field in the database
	 */
	public function delete( $id )
	{
		global $wpdb, $db_sendylists;

		// delete sendylist from the db
		$sql = "
			DELETE FROM `$db_sendylists`
			WHERE `id` = '%d'
		";
		$wpdb->query( $wpdb->prepare( $sql, $id ) );
	}


	/**
	 * Populates the properties of this object with posted form values
	 * id
	 * name
	 * sendyurl
	 * apikey
	 * list
	 * created_date (set to now)
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
		// sendyurl
		if ( isset( $_POST['sendyurl'] ) && $_POST['sendyurl'] != '' ) {
			$this->sendyurl = $_POST['sendyurl'];
		}
		// apikey
		if ( isset( $_POST['apikey'] ) && $_POST['apikey'] != '' ) {
			$this->apikey = $_POST['apikey'];
		}
		// list
		if ( isset( $_POST['list'] ) && $_POST['list'] != '' ) {
			$this->list = $_POST['list'];
		}
		// created_date (set to now)
		$this->created_date = current_time( 'mysql', 0 );

	}

	/**
	 * Retrieves a list of sendylists to populate select box navigation
	 * Only queries the info needed to populate select box 
	 *
	 * @return (object) query results
	 */
	public function quicklist()
	{
		global $wpdb, $db_sendylists;

		$sql = "
			SELECT id, name
			FROM `$db_sendylists`
		";
		$query_results = $wpdb->get_results( $sql );

		return $query_results;
	}


	public function get($id)
	{
		global $wpdb, $db_sendylists;

		$sql = "
			SELECT id, name, sendyurl, apikey, list, created_date
			FROM $db_sendylists
			WHERE id = $id
		";
		$sendylist = $wpdb->get_results( $sql );

		if(count($sendylist) == 1) return $sendylist[0];
		return null;
	}


	/**
	 * Reads a sendylist record from the database
	 * 
	 * @param (int) $id value of the sendylist's 'id' field in the database
	 * @return (bool) true if query returns a result, false if no results found
	 */
	public function retrieve( $id )
	{
		global $wpdb, $db_sendylists;

		$sql = "
			SELECT $db_sendylists.*
			FROM $db_sendylists
			WHERE $db_sendylists.id = $id
		";
		$sendylist = $wpdb->get_row( $sql );
		
		$rowcount = $wpdb->get_var( $sql );
		if ( $rowcount > 0 ) {
			$this->_populate_from_query( $sendylist );
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Updates an existing sendylist record in the database
	 * id
	 * name
	 * sendyurl
	 * apikey
	 * list
	 * 
	 * @param (int) $id value of the sendylist's 'id' field in the database
	 */
	public function update( $id )
	{
		global $wpdb, $db_sendylists;

		$data = array(
			'name'     => $this->name,
			'sendyurl' => $this->sendyurl,
			'apikey'   => $this->apikey,
			'list'     => $this->list
		);
		$where = array( 'id' => $id );

		$wpdb->update( $db_sendylists, $data, $where );
	}

	//********************************************************************************
	//* Private
	//********************************************************************************

	/**
	 * Populates the parameters of this object with values from the database 
	 * 
	 * @param (object) $sendylist database query results
	 */
	private function _populate_from_query( $sendylist )
	{
		$this->id           = $sendylist->id;
		$this->name         = $sendylist->name;
		$this->sendyurl     = $sendylist->sendyurl;
		$this->apikey       = $sendylist->apikey;
		$this->list         = $sendylist->list;
		$this->created_date = $syncjob->created_date;
	}
}

?>