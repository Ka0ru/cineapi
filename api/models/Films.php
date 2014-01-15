<?php

class Films{

	private function connect_db(){
		$database = new DB\SQL(
					    'mysql:host=localhost;port=3306;dbname=cineapi',
					    'root',
					    ''
					);
		return $database;
	}

	public function listAllFilms(){
		$db = $this->connect_db();
		$query = "SELECT titre, prenom_realisateur, nom_realisateur, genre
				FROM film";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	public function searchFilms(){
		$db = $this->connect_db();
		$query = "SELECT titre, prenom_realisateur, nom_realisateur, genre
				FROM film
				WHERE titre
				LIKE '%".F3::get('PARAMS.id')."%'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

}