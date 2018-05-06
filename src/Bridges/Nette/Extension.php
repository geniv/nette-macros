<?php

namespace Macros\Bridges\Nette;

use Macros\MacroConfirm;
use Macros\MacroIfCurrent;
use Macros\MacroSubmitButton;
use Nette\DI\CompilerExtension;


/**
 * Class Extension
 *
 * @author  geniv
 * @package Macros\Bridges\Nette
 */
class Extension extends CompilerExtension
{

    /**
     * Before Compile.
     */
    public function beforeCompile()
    {
        $builder = $this->getContainerBuilder();

        // load macro to latte
        $latteFactory = $builder->getDefinition('latte.latteFactory');
        $latteFactory->addSetup(MacroIfCurrent::class . '::install(?->getCompiler())', ['@self']);
        $latteFactory->addSetup(MacroSubmitButton::class . '::install(?->getCompiler())', ['@self']);
        $latteFactory->addSetup(MacroConfirm::class . '::install(?->getCompiler())', ['@self']);
    }
}
