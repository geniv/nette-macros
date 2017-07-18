<?php

namespace Macros\Bridges\Nette;

use Macros\MacroConfirm;
use Macros\MacroIfCurrentIn;
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
        'IfCurrentIn'  => false,
        'SubmitButton' => false,
        'Confirm'      => false,
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
        if ($config['IfCurrentIn']) {
            $latteFactory->addSetup('?->onCompile[] = function ($engine) { ' . MacroIfCurrentIn::class . '($engine->getCompiler()); }', ['@self']);
        }
        if ($config['SubmitButton']) {
            $latteFactory->addSetup('?->onCompile[] = function ($engine) { ' . MacroSubmitButton::class . '($engine->getCompiler()); }', ['@self']);
        }
        if ($config['Confirm']) {
            $latteFactory->addSetup('?->onCompile[] = function ($engine) { ' . MacroConfirm::class . '($engine->getCompiler()); }', ['@self']);
        }
    }
}
