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

	//-------------------------GET FUNCTIONS------------------------//
	//Afficher la liste de tous les films
	public function listAllFilms(){
		$db = $this->connect_db();
		$query = "SELECT titre, prenom_realisateur, nom_realisateur, genre, sortie, recettes
				FROM film";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//Rechercher un film
	public function searchFilms(){
		$db = $this->connect_db();
		$query = "SELECT titre, prenom_realisateur, nom_realisateur, genre, sortie, recettes
				FROM film
				WHERE titre
				LIKE '%".F3::get('PARAMS.id')."%'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------POST(CREATE) FUNCTIONS------------------------//
	//Créer un film
	public function createFilm(){
		$db = $this->connect_db();
		$titre = F3::get('POST.titre');
		$prenom_realisateur = F3::get('POST.prenom_realisateur');
		$nom_realisateur = F3::get('POST.nom_realisateur');
		$genre = F3::get('POST.genre');
		$sortie = F3::get('POST.sortie');
		$recettes = F3::get('POST.recettes');

		$query = "INSERT INTO film(titre, prenom_realisateur, nom_realisateur, genre, sortie, recettes)
				VALUES ('$titre', '$prenom_realisateur', '$nom_realisateur', '$genre', '$sortie', '$recettes')";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------DELETE FUNCTIONS------------------------//
	//Modifier les infos d'un utilisateur
	public function deleteFilm(){
		$db = $this->connect_db();
		$idfilm = F3::get('GET.idfilm');

		$query = "DELETE FROM film
				WHERE idfilm = '$idfilm'";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------PUT (UPDATE) FUNCTIONS------------------------//
	//Modifier les infos d'un utilisateur
	public function updateFilm(){
		$db = $this->connect_db();
		$titre = F3::get('PARAMS.id');
		$new_titre = F3::get('GET.titre');
		$prenom_realisateur = F3::get('GET.prenomreal');
		$nom_realisateur = F3::get('GET.nomreal');
		$genre = F3::get('GET.genre');
		$recettes = F3::get('GET.recettes');

		$query = "UPDATE film
				SET
					titre = '$new_titre',
					prenom_realisateur = '$prenom_realisateur',
					nom_realisateur = '$nom_realisateur',
					genre = '$genre',
					recettes = '$recettes'
				WHERE titre = '$titre'";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

}