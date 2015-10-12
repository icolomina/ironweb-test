<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ApiInputDataValidatorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container){

        if (!$container->has('api.input_data_validator_collection')) {
            return;
        }

        $definition = $container->findDefinition('api.input_data_validator_collection');
        $taggedServices = $container->findTaggedServiceIds('api.input_data_validator');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'set',
                array($tags[0]['alias'], new Reference($id))
            );
        }

    }
}