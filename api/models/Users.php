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

	//-------------------------GET FUNCTIONS------------------------//
	//Afficher la liste de tous les utilisateurs
	public function listAllUsers(){
		$db = $this->connect_db();
		$query = "SELECT username, email, date_create, token
				FROM user";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//Rechercher un utilisateur
	public function searchUsers(){
		$db = $this->connect_db();
		$query = "SELECT username, email, date_create, token
				FROM user
				WHERE username
				LIKE '%".F3::get('PARAMS.id')."%'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//Afficher les films aimés par un utilisateur en particulier
	public function listUserLikes(){
		$db = $this->connect_db();
		$username = F3::get('PARAMS.id');
		$token = F3::get('GET.token');
		$query = "SELECT
			        f.titre,
			        f.prenom_realisateur,
			        f.nom_realisateur,
			        f.genre
			    FROM
			        `like` as l
			    LEFT JOIN user as u ON u.id = l.id_user 
			    LEFT JOIN film as f ON f.idfilm = l.id_film
			    WHERE u.username = '$username' AND u.token = '$token'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//Afficher les films vus par un utilisateur en particulier
	public function listUserSeen(){
		$db = $this->connect_db();
		$username = F3::get('PARAMS.id');
		$token = F3::get('GET.token');
		$query = "SELECT
		        f.titre,
		        f.prenom_realisateur,
		        f.nom_realisateur,
		        f.genre
		    FROM
		        `a_vu` as vu
		    LEFT JOIN user as u ON u.id = vu.id_user 
		    LEFT JOIN film as f ON f.idfilm = vu.id_film
			WHERE u.username = '$username' AND u.token = '$token'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//Afficher les films qu'un utilisateur aimerait voir
	public function listUserWouldLikeToSee(){
		$db = $this->connect_db();
		$username = F3::get('PARAMS.id');
		$token = F3::get('GET.token');
		$query = "SELECT
		        f.titre,
		        f.prenom_realisateur,
		        f.nom_realisateur,
		        f.genre
		    FROM
		        `aimerait_voir` as av
		    LEFT JOIN user as u ON u.id = av.id_user 
		    LEFT JOIN film as f ON f.idfilm = av.id_film
			WHERE u.username = '$username' AND u.token = '$token'";
		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------POST(CREATE) FUNCTIONS------------------------//
	//Créer un utilisateur
	public function createUser(){
		$db = $this->connect_db();
		$username = F3::get('POST.username');
		$password = md5(F3::get('POST.password'));
		$email = F3::get('POST.email');
		$date_create = 'NOW()';
		$token = md5(time()*rand(1,10));
		$status = F3::get('POST.status');

		$query = "INSERT INTO user(username, password, email, date_create, token, status)
				VALUES ('$username', '$password', '$email', $date_create, '$token', '$status')";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------DELETE FUNCTIONS------------------------//
	//Supprimer les infos d'un utilisateur
	public function deleteUser(){
		$db = $this->connect_db();
		$username = F3::get('PARAMS.id');
		$token = F3::get('GET.token');

		$query = "DELETE FROM user
				WHERE username = '$username' AND token = '$token'";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}

	//-------------------------PUT (UPDATE) FUNCTIONS------------------------//
	//Modifier les infos d'un utilisateur
	public function updateUser(){
		$db = $this->connect_db();
		//$username = F3::get('PARAMS.id');
		$new_username = F3::get('GET.username');
		$password = md5(F3::get('GET.password'));
		$email = F3::get('GET.email');
		$token = F3::get('GET.token');

		$query = "UPDATE user
				SET
					username = '$new_username',
					password = '$password',
					email = '$email'
				WHERE token = '$token'";

		$db->begin();
		$do_query = $db->exec($query);
		$db->commit();

		return $do_query;
	}
}