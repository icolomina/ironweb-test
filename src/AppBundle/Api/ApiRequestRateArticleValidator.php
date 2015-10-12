<?php

namespace AppBundle\Api;

class ApiRequestRateArticleValidator extends ApiRequestValidator {

    /**
     *
     */
    public function __construct(){

        parent::__construct();

        $this->optionsResolver->setRequired(array('rate'));
        $this->optionsResolver->setAllowedTypes(array('rate' => 'numeric'));
        $this->optionsResolver->setAllowedValues('rate', array(1, 2, 3, 4, 5));
    }
}