<?php

namespace Macros\Bridges\Nette;

use Macros\MacroConfirm;
use Macros\MacroIfCurrent;
use Macros\MacroIfCurrentIn;
use Macros\MacroIfCurrentSwitch;
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
    /** @var array default values */
    private $defaults = [
        'ifCurrent'       => false,
        'ifCurrentIn'     => false,
        'ifCurrentSwitch' => false,
        'submitButton'    => false,
        'confirm'         => false,
    ];


    /**
     * Before Compile.
     */
    public function beforeCompile()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults);

        // load macro to latte
        $latteFactory = $builder->getDefinition('latte.latteFactory');
        if ($config['ifCurrent']) {
            $latteFactory->addSetup(MacroIfCurrent::class . '::install(?->getCompiler())', ['@self']);
        }
        if ($config['ifCurrentIn']) {
            $latteFactory->addSetup(MacroIfCurrentIn::class . '::install(?->getCompiler())', ['@self']);
        }
        if ($config['ifCurrentSwitch']) {
            $latteFactory->addSetup(MacroIfCurrentSwitch::class . '::install(?->getCompiler())', ['@self']);
        }
        if ($config['submitButton']) {
            $latteFactory->addSetup(MacroSubmitButton::class . '::install(?->getCompiler())', ['@self']);
        }
        if ($config['confirm']) {
            $latteFactory->addSetup(MacroConfirm::class . '::install(?->getCompiler())', ['@self']);
        }
    }
}
