<?php

$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=cineapi',
    'root',
    ''
);

    /****/


$f3->set('titre', $db->exec("SELECT titre, prenom_realisateur, nom_realisateur, genre FROM film WHERE titre LIKE '%".F3::get('PARAMS.id')."%'"));
echo Template::instance()->render('abc.html');







