<?php
class Admin_Form_Stclab extends Zend_Form {
    public function init() {
        $this->setMethod('post');
        
        
        
        $this->addElement('text', 'title', array(
            'label' => 'Title :',
            'required' => true
        ));
        $this->title->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        
        $this->addElement('text', 'ordering', array(
            'label' => 'Ordering:',
            'required' => true
        ));
        $this->ordering->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        
        $this->addElement('textarea', 'description', array(
            'label' => 'Description :',
            'required' => true
        ));
        $this->description->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('textarea', 'video_link', array(
            'label' => 'Video Link :',
            'required' => true
        ));
        $this->video_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('textarea', 'watch_it_link', array(
            'label' => 'Watch It Link :',
            'required' => true
        ));
        $this->watch_it_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'c_date', array(
            'label' => 'Date :',
            'required' => true
        ));
        $this->c_date->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
         $this->addElement('checkbox', 'publish_to_banner', array(
            'label' => 'Show in Slider? :',
            'options' => array(
                'use_hidden_element' => true,
                'checkedValue' => '1',
                'uncheckedValue' => '0'
            )
        ));
       $this->addElement('file', 'banner_image_file', array(
            'label' => 'Slider Image:',
            'description' => 'best when 1920 x 684',
            'destination' => 'public/uploads/stclab',
        ));
        $this->banner_image_file->setAttrib('class', 'txt');
        $this->addElement('image', 'banner_image_file_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
        
        
        $this->addElement('checkbox', 'show_in_homepage', array(
            'label' => 'Show in Homepage? :',
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