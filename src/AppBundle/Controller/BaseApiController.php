<?php

namespace AppBundle\Controller;

use AppBundle\Exception\ApiInputDataException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiController extends Controller implements ApiControllerInterface
{

    /**
     * @return mixed
     */
    protected function getEmail(){

        return $this->get('request')->attributes->get('REQ_EMAIL');
    }

    /**
     * @param $content
     * @return Response
     */
    protected function createApiResponse($content){

        return new Response($content, 200, array(
            'Content-Type: application/json'
        ));
    }

    /**
     * @param $action
     */
    protected function validateInputData(Array $data, $action){

        $entry = $this->get('api.input_data_validator_collection')->get($action);
        if(!$entry->isEmpty()){

            try {

                $entry->get()->validate($data);
            }
            catch(\Exception $e){

                throw new ApiInputDataException($e->getMessage());
            }
        }
    }

}