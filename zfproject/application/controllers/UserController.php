<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        
    	$form= new Application_Form_User();
    	
    	//$element->addFilter(new Zend_Filter_File_Rename(array('target' => 'config.ini')));
  
    	$request=$this->getRequest();
    	if($request->isPost())
    	{
    		if($form->isValid($this->_request->getPost()))
    		{
    			
    			
    			$user_model =new Application_Model_User();
    			
    			
    			if($form->image->isUploaded()){
    				
    				$form->image->receive();
    				
    				$r=$user_model->addUser($form->getValues());
    				
    			    $img='http://localhost/zfproject/public/upload/' .basename($form->image->getFileName(),"asd");
    	
    				//  echo  $img;
    				//echo "<img src=$img />";
    				$subject="test";
    				$htmlMessage="d";
    				$sender="ahmedsd676@gmail.com";
    				$message="sdsf";
    	 	
    				try {
    			        $tr = new Zend_Mail_Transport_Smtp('smtp.mail.yahoo.com', array(
					    'ssl'=>'tls',
    			        'auth'     => 'login',
					    'username' => '2222',
					    'password' => '4444',
					    'port'     => 587,
					));
					Zend_Mail::setDefaultTransport($tr);
					$mail =  new Zend_Mail();
					$mail->setBodyText('This is the text of the mail.');
					$mail->setFrom('ahmedsd676@ymail.com', 'Admin');
					$mail->addTo($form->getValue('email'), 'Some Recipient');
					$mail->setSubject('TestSubject');
					$mail->send();
    					
    				
    				} catch (Zend_Exception $e) {
    					echo $e->getMessage(); //exit;
    				}
  

					    				
    				
    				
    			}
    			//$this->redirect('user/add');
    		}
    		
    	
    	}
    	
    
    	//$location = $form->foo->getFileName();
    	//echo $location;
    	$this->view->form=$form;
    	
    }

    public function editAction()
    {
        // action body

    	
    	

    	$uid;
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    		 
    		if($userdata->role !='admin'){
    			$this->redirect('/authentiction/login');
    		}
    		 
    		 
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	 
    	 

    	
    	

    	$form= new Application_Form_UserEditForm();
    	 
    	
   
    	
    	$fid = $this->getRequest()->getParam('id');
    
    	$user_model = new Application_Model_User();
    	
    	$name = $user_model->getUserById($fid);
   
  		/* print_r($name);
  		exit;
     */
    	
    	////////////////////////////////////////
    	

    	$firstname=$form->getElement('fistname');
    	$firstname->setValue($name[0]['fname']);
    	 

    	 
    	
    	$firstname=$form->getElement('lastname');
    	$firstname->setValue($name[0]['lname']);

    	$firstname=$form->getElement('middlename');
    	$firstname->setValue($name[0]['mname']);
    	 
   
 
    	$firstname=$form->getElement('gender');
    	//$i=$name[0]['gender'];
 //   $firstname->setValue($genders[$i]);
    $firstname->setValue($name[0]['gender']);
    	
    	$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
  
    	
    	$firstname=$form->getElement('country');
    	//$firstname->setValue($countries[$name[0]['country']]);
    	 
    	$firstname->setValue($name[0]['country']);
    	 
    	$imgs=$form->getElement('image');
        $this->view->imgsrc=$name[0]['photo'];
        $imgs->setValue($name[0]['photo']);
       
    	
    	
        		

    	$firstname=$form->getElement('locked');
    	$firstname->setValue($name[0]['status']);
    	
    	

    	$firstname=$form->getElement('role');
    	$firstname->setValue($name[0]['role']);
    	 
    	 
    	 


    	$firstname=$form->getElement('signature');
    	$firstname->setValue($name[0]['signature']);
    
    	
    	 
    	 
    	 
    	
    	////////////////////////////////////////
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	if($this->getRequest()->isPost()){
    	
    		if($form->isValid($this->getRequest()->getParams())){

    			if($form->image->isUploaded()){
    			
    				$form->image->receive();
    			
    			}
    			
    			$user_model->editUser($fid, $form->getValues());
    			$this->_redirect("users/list/");
    			
    		}
    	}    	
    	
    	
    	
    	$this->view->form=$form;
    	
    	
    }

    public function deleteAction()
    {
        // action body
        
    	$del_modle=new Application_Model_User();
    	$id =$this->_request->getParam('id');
    	//echo $id;
    	//exit;
    	$del_modle->deleteUser($id);
    	$this->redirect('/users/list');
    	
    	
    	
    	
    }

    public function banAction()
    {
        // action body
    }

    public function profileAction()
    {
        // action body
        
    	
    	
    	


    	$uid;
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    		 
    		if($userdata->role !='admin'){
    			$this->redirect('/authentiction/login');
    		}
    		 
    		 
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	
    	
    	
    	 
    	 
    
    	
    	 
    	 
    	 
    	$fid = $this->getRequest()->getParam('id');
    	
    	$user_model = new Application_Model_User();
    	 
    	$name = $user_model->getUserById($fid);
    	
    	
    	
    	echo"
    			
    		<img src=http://localhost/zfproject/public/upload/{$name[0]['photo']}   width=100 height=100 />	<br />
    		<p>firstname:{$name[0]['fname']} </p>
    		<p>country:{$name[0]['country']} </p>

    			
    	";
  
    	
    	
    	
    }


}











