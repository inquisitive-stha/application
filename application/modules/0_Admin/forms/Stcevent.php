<?php
class Admin_Form_Stcevent extends Zend_Form {
    public function init() {
        $this->setMethod('post');
        
        
        
        
        
        
        $this->addElement('text', 'title', array(
            'label' => 'Title :',
            'required' => true
        ));
        $this->title->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'c_date', array(
            'label' => 'Event Date :',
            'required' => true
        ));
        $this->c_date->setAttrib('class', 'txt')->addValidator('NotEmpty'); 
         
        $this->addElement('textarea', 'description', array(
            'label' => 'Description  :',
            'required' => true
        ));
        $this->description->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('textarea', 'teaser_link', array(
            'label' => 'Teaser Link  :'
        ));
        $this->teaser_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
         $this->addElement('textarea', 'ticket_link', array(
            'label' => 'Ticket Link  :'
        ));
        $this->ticket_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        $this->addElement('textarea', 'show_page_link', array(
            'label' => 'Show Page Link  :'
        ));
        $this->show_page_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        $this->addElement('textarea', 'after_movie_link', array(
            'label' => 'After Movie Link  :'
        ));
        $this->after_movie_link->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
              
        $this->addElement('file', 'homepage_image', array(
            'label' => 'Homepage Image :',
            'description' => 'best when 720 x 479',
            'destination' => 'public/uploads/stcevent',
        ));              
        $this->homepage_image->setAttrib('class', 'txt');
        $this->addElement('image', 'homepage_image_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
        $this->addElement('checkbox', 'publish_to_homepage', array(
            'label' => 'Show in Homepage? :',
            'options' => array(
                'use_hidden_element' => true,
                'checkedValue' => '1',
                'uncheckedValue' => '0'
            )
        ));
              
        
        $this->addElement('file', 'event_page_image', array(
            'label' => 'Event Page Image :',
             'description' => 'best when 1595 x 591',
            'destination' => 'public/uploads/stcevent',

            
        ));
         $this->event_page_image->setAttrib('class', 'txt');         
         $this->addElement('image', 'event_page_image_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
         
         $this->addElement('checkbox', 'show_in_slider', array(
            'label' => 'Show in Slider? :',
            'options' => array(
                'use_hidden_element' => true,
                'checkedValue' => '1',
                'uncheckedValue' => '0'
            )
        ));
        $this->addElement('file', 'slider_image', array(
            'label' => 'Slider Image :',
            'description' => 'best when 1920 x 681',
            'destination' => 'public/uploads/stcevent',
        ));
        $this->homepage_image->setAttrib('class', 'txt');
        $this->addElement('image', 'slider_image_pic', array(
            'label' => '',
            'class' => 'm_image',
            'src' => '',
            'style' => 'height: 150px;'
        ));
        
         
        
        
        $this->addElement('checkbox', 'is_previous', array(
            'label' => 'is Previous? :',
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