<?php

class FilmsController{

		private $model = null;

        public function __construct(){
        		$this->model = new Films();
        }

        public function actionFind(){
        		$content = $this->model->listAllFilms();
                Api::response(200, $content);
        }

        public function actionCreate(){
        		$content = $this->model->createFilm();
                if($content){
                        //$data = array('Create film with name ' . $_POST['name']);
                        Api::response(200, array('valid', 'The film was successfully added'));
                }
                else{
                        Api::response(400, array('error', 'Oops, a problem occured, please try again'));
                }
        }

        public function actionFindOne(){
                $content = $this->model->searchFilms();
                Api::response(200, $content);
        }

        public function actionDelete(){
                $content = $this->model->deleteFilm();
                Api::response(200, array('valid', 'The film was successfully deleted'));
        }

        public function actionUpdate(){
                $this->model->updateFilm();
                Api::response(200, array('valid', 'The film was successfully updated'));
        }

}