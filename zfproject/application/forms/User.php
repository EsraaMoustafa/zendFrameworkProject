<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setName('Register');
    	
    	$firstname= new Zend_Form_Element_Text('fistname');
    	$firstname ->setLabel('First name:')
    				->setRequired(true)
    				->setValidators(array(new Zend_Validate_Alpha(true)));
    	
    	$lastname= new Zend_Form_Element_Text('lastname');
    	$lastname ->setLabel('Last name:')
			    	->setRequired(true)
			    	->setValidators(array(new Zend_Validate_Alpha()));
    	
    	$middlename= new Zend_Form_Element_Text('middlename');
    	$middlename ->setLabel('Middle name:')
			    	->setRequired(true)
			    	->setValidators(array(new Zend_Validate_Alpha()));
    	
    	
    	$email=new Zend_Form_Element_Text('email');
    	$email->setLabel('Email:')
    		   ->setRequired(true)
    		   ->setValidators(array(new Zend_Validate_EmailAddress()));
    	
    	
    	$password=new Zend_Form_Element_Password('password');
    	$password->setLabel('Password:')
		    	->setRequired(true);
    	
    	
    	$re_password = new Zend_Form_Element_Password("re_password");
    	$re_password->setRequired();
    	$re_password->setLabel("Retype Password:");
    	$re_password->addValidator('identical', false, array('token' => 'password'));
    	

    	
    	$gender=new Zend_Form_Element_Radio('gender');
    	$gender->addMultiOptions(array('Female','Male'))
    			->setLabel('Gender:')
    			->setRequired(true);
    	
    	$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    	$country=new Zend_Form_Element_Select('country');
    	$country->addMultiOptions($countries)
    			->setLabel('Country:')
    			->setRequired(true);
    	
    	
    	$element = new Zend_Form_Element_File('image');
		$element->setLabel('Upload an image:')
			->setDestination(APPLICATION_PATH .'/../public/upload');
			// ensure only 1 file
		$element->addValidator('Count', false, 1);
			// limit to 100K
		$element->addValidator('Size', false, 802400);
			// only JPEG, PNG, and GIFs
		$element->addValidator('Extension', false, 'jpg,png,gif,jpeg');
		$element->setAttrib('enctype', 'multipart/form-data');
    	
    	
    	$register=new Zend_Form_Element_Submit('Regist');

		
    	$Signature= new Zend_Form_Element_Textarea("signature");
    	$Signature->setLabel("Signature:")
    				->setAttrib("cols", "30")
    				->setAttrib("rows", "10");  

    	
    	
    	$publickey = '6LcwHQMTAAAAABvO_ZkaoYYGfLhLiI_QjF4fsaHO';
    	$privatekey = '6LcwHQMTAAAAAGYuyYREerqVR23r7Cf_xIemPocL';
    	$recaptcha = new Zend_Service_ReCaptcha($publickey, $privatekey);
    	
    	$captcha = new Zend_Form_Element_Captcha('captcha',
    			array(
    					'captcha'       => 'ReCaptcha',
    					'captchaOptions' => array('captcha' => 'ReCaptcha', 'service' => $recaptcha),
    					'ignore' => true
    			)
    	);

	$this->setMethod('post');    	
    	$this->addElements(array($firstname,
    			$middlename,
    			$lastname,
    			$email,
    			$password,
    			$re_password,
    			$gender,
    			$country,
    			$element,
    			$Signature,
    			$captcha,
    		   $register));

    	
    }


}

