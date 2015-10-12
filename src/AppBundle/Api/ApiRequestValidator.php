<?php

namespace AppBundle\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class ApiRequestValidator
{
    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     *
     */
    public function __construct(){

        $this->optionsResolver = new OptionsResolver();


    }

    /**
     * @param array $apiData
     */
    public function validate(Array $apiData){

        $this->optionsResolver->resolve($apiData);
    }
}