<?php

class UsersController{

		private $model = null;

        public function __construct(){
        		$this->model = new Users();
        }

        public function actionFind(){
        		$content = $this->model->listAllUsers();
                Api::response(200, $content);
        }

        public function actionFindOne(){
                $content = $this->model->searchUsers();
                Api::response(200, $content);
        }

        public function actionCreate(){
        		$content = $this->model->createUser();
                if($content){
                        //$data = array('Create film with name ' . $_POST['name']);
                        Api::response(200, array('valid', 'The user was successfully added'));
                }
                else{
                        Api::response(400, array('error', 'Oops, a problem occured, please try again'));
                }
        }

        public function actionUpdate(){
                $this->model->updateUser();
                Api::response(200, array('valid', 'The user was successfully updated'));
        }

        public function actionDelete(){
                $this->model->deleteUser();
                Api::response(200, array('valid', 'The user was successfully deleted'));
        }

        public function actionListLikes(){
        		$content = $this->model->listUserLikes();
        		Api::response(200, $content);
        }

        public function actionListSeen(){
        		$content = $this->model->listUserSeen();
        		Api::response(200, $content);
        }

        public function actionListWouldLikeToSee(){
        		$content = $this->model->listUserWouldLikeToSee();
        		Api::response(200, $content);
        }
    
}