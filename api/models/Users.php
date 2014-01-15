<?php

class Users{

	private function connect_db(){
		$database = new DB\SQL(
					    'mysql:host=localhost;port=3306;dbname=cineapi',
					    'root',
					    ''
					);
		return $database;
	}

	public function listAllUsers(){
		$db = $this->connect_db();
		$query = "SELECT username, email
				FROM user";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	public function searchUsers(){
		$db = $this->connect_db();
		$query = "SELECT username, email
				FROM user
				WHERE username
				LIKE '%".F3::get('PARAMS.id')."%'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	public function listUserLikes(){
		$db = $this->connect_db();
		$query = "SELECT
			        f.titre,
			        f.prenom_realisateur,
			        f.nom_realisateur,
			        f.genre
			    FROM
			        `like` as l
			    LEFT JOIN user as u ON u.id = l.id_user 
			    LEFT JOIN film as f ON f.idfilm = l.id_film
			    WHERE u.username = '".F3::get('PARAMS.id')."'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	public function listUserSeen(){
		$db = $this->connect_db();
		$query = "SELECT
		        f.titre,
		        f.prenom_realisateur,
		        f.nom_realisateur,
		        f.genre
		    FROM
		        `a_vu` as vu
		    LEFT JOIN user as u ON u.id = vu.id_user 
		    LEFT JOIN film as f ON f.idfilm = vu.id_film
			WHERE u.username = '".F3::get('PARAMS.id')."'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	public function listUserWouldLikeToSee(){
		$db = $this->connect_db();
		$query = "SELECT
		        f.titre,
		        f.prenom_realisateur,
		        f.nom_realisateur,
		        f.genre
		    FROM
		        `aimerait_voir` as av
		    LEFT JOIN user as u ON u.id = av.id_user 
		    LEFT JOIN film as f ON f.idfilm = av.id_film
			WHERE u.username = '".F3::get('PARAMS.id')."'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

}