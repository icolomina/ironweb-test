<?php

namespace AppBundle\Api;

class ApiRequestAnswerArticleValidator extends ApiRequestValidator {

    /**
     *
     */
    public function __construct(){

        parent::__construct();

        $this->optionsResolver->setRequired(array('answer'));
        $this->optionsResolver->setAllowedTypes(array('answer' => 'string'));
    }
}