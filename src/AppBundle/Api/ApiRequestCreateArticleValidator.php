<?php

namespace AppBundle\Api;

class ApiRequestCreateArticleValidator extends ApiRequestValidator {

    /**
     *
     */
    public function __construct(){

        parent::__construct();

        $this->optionsResolver->setRequired(array('text', 'title', 'description'));
        $this->optionsResolver->setAllowedTypes(array(
            'text' => 'string',
            'title' => 'string',
            'description'=> 'string'
        ));
    }
}