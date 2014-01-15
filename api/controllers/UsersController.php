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

        /*public function actionCreate(){
                if(isset($_POST['name'])){
                        $data = array('Create film with name ' . $_POST['name']);
                        Api::response(200, $data);
                }
                else{
                        Api::response(400, array('error'=>'Name is missing'));
                }
        }*/

        public function actionFindOne(){
                $content = $this->model->searchUsers();
                Api::response(200, $content);
        }

        /*public function actionUpdate(){

                $data = Put::get();

                if(isset($data['name'])){
                        $data = array('Update film with name: ' . F3::get('PARAMS.id') . ' with name: '. $data['name']);
                        Api::response(200, $data);
                }
                else{
                        Api::response(400, array('error'=>'Name is missing'));
                }
        }

        public function actionDelete(){
                $data = array('Delete film with name: ' . F3::get('PARAMS.id'));
                Api::response(200, $data);
        }*/

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