<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\ApiInputDataValidatorPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ApiInputDataValidatorPass());
    }
}
