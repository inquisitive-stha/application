<?php
class Admin_Form_Stcartist extends Zend_Form {
    public function init() {
        $this->setMethod('post');
         $this->addElement('text', 'title', array(
            'label' => 'Title:',
            'required' => true
        ));
        $this->title->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        $this->addElement('text', 'ordering', array(
            'label' => 'Ordering:',
            'required' => true
        ));
        $this->ordering->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        $this->addElement('textarea', 'description', array(
            'label' => 'Excerpt :',
            'required' => true,
            'description' => 'This appears in the Listing'
        ));
        $this->description->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('textarea', 'long_description', array(
            'label' => 'Long Description :',
            'required' => true
        ));
        $this->long_description->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
         $this->addElement('file', 'image_file', array(
            'label' => 'Image 1 :',
            'description' => 'best when 720 x 480',
            'destination' => 'public/uploads/stcartist',
        ));
         $this->addElement('image', 'image_file_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
         
         $this->addElement('file', 'image_file_2', array(
            'label' => 'Image 2 :',
            'description' => 'best when 720 x 480',
            'destination' => 'public/uploads/stcartist',
        ));
         $this->addElement('image', 'image_file_2_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
         
         
         $this->addElement('file', 'image_file_3', array(
            'label' => 'Image 3 :',
            'description' => 'best when 720 x 480',
            'destination' => 'public/uploads/stcartist',
        ));
         $this->addElement('image', 'image_file_3_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
         
         
         
         
         
         $this->addElement('checkbox', 'publish_to_banner', array(
            'label' => 'in Slider? :',
            'options' => array(
                'use_hidden_element' => true,
                'checkedValue' => '1',
                'uncheckedValue' => '0'
            )
        ));
        
       	$this->addElement('file', 'banner_image_file', array(
            'label' => 'Slider Image :',
            'description' => 'best when 1920 x 684',
            'destination' => 'public/uploads/stcartist',
        ));
        
        $this->addElement('image', 'banner_image_file_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
       
        
        
        
        
        $this->addElement('checkbox', 'show_in_homepage', array(
            'label' => 'in Homepage? :',
            'options' => array(
                'use_hidden_element' => true,
                'checkedValue' => '1',
                'uncheckedValue' => '0'
            )
        ));

        
        $this->addElement('submit', 'submit', array(


          'ignore'   => true,


            'label'    => 'Add',


        ));
       
         $this->submit->setAttrib('class', 'button altbutton');





        $this->addElement('button', 'cancel', array(
          'ignore'   => true,
            'label'    => 'Cancel',
        ));


        $this->cancel->setAttrib('class', 'button altbutton');
        $this->cancel->setAttrib('onclick', 'history.go(-1);');


          $this->setDecorators(array(
                    'FormElements',
         			array(array('e' => 'HtmlTag'), array('tag' => 'dl')),
         			array(array('e1' => 'HtmlTag'), array('tag' => 'div', 'class' => 'inner-form')),
         			'Form'
        ));


        $this->setAttrib('class', 'basic');


	}


}