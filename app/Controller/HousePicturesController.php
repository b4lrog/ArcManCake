<?php
class HousePicturesController extends AppController{
	public $helper = array('Html','Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Session->write('menue.active','HousePictures');
	}
	
	public function isAuthorized($logged_user) {

		if ($logged_user['role']>2) {
			$this->Session->setFlash(__('Acces denied: Low cleareance access'));
			return FALSE; # Overseers have the same privileges as visitors
		}elseif(in_array($this->action, array('index','view','edit','delete'))){
			return TRUE;
		}
		
		return parent::isAuthorized($logged_user);
	}
	
	
	public function index($house_id=NULL) {
		$logged_user = $this->Auth->user();
		if ($house_id==NULL){
			$this->set('house_pictures_view',$this->paginate());
		}else{
			$this->set('house_pictures_view',$this->paginate('HousePicture',array('HousePicture.house_id'=>$house_id)));
			$this->request->data['HousePicture']['house_id'] = $house_id;
		}
		$this->set('house_id_view',$house_id);
		
		// add
		if ($logged_user['role']<3 && !empty($logged_user)){
			
			$this->set('house_id_view',$house_id);
			$this->set('list_houses_view',$this->HousePicture->MyHouse->find('list'));
			
			if ($this->request->is('post')) {
				$this->HousePicture->create();
				//Check if image has been uploaded
				if(!empty($this->request->data['HousePicture']['upload']['name']))
				{
					$file = $this->request->data['HousePicture']['upload']; //put the data into a var for easy use
				
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
				
					//only process if the extension is valid
					if(in_array($ext, $arr_ext)){
						//do the actual uploading of the file. First arg is the tmp name, second arg is
						//where we are putting it
						move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/houses/' . $file['name'].$house_id);
				
						//prepare the filename for database entry
						
						$this->request->data['HousePicture']['picture'] = $file['name'].$house_id;
						
						
					}else{
						$this->Session->setFlash(__('File not saved, you must use a picture.'));
					}
				}
				
				$this->request->data['HousePicture']['picture'] = $file['name'];
				
				if ($this->HousePicture->save($this->request->data)) {
					$this->Session->setFlash(__('Picture saved.'));
					return $this->redirect(array('action' => 'index',$house_id));
				}
				$this->Session->setFlash(__('Unable to add the picture.'));
			}
		}
	}


	public function view($id=null) {
            if(!$id){
                throw new NotFoundException(__('Invalid picture'));
            }
	
            $x = $this->HousePicture->findById($id);
            if (!$x) {
                throw new NotFoundException(__('Invalid picture'));
            }
            $this->set('house_picture_view',$x);

	}

        
	
    public function delete($id) {
    	if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
        }
        $x=$this->HousePicture->findById($id);
        unlink(WWW_ROOT.'img/uploads/houses/'.$x['HousePicture']['picture']);
        if ($this->HousePicture->delete($id)) {
        	$this->Session->setFlash(__('Picture with id: %s has been deleted',h($id)));
            return $this->redirect(array('action'=>'index'));
        }
    }
   
  	
}
