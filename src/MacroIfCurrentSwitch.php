<?php

namespace Macros;

use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;


/**
 * Class MacroIfCurrentSwitch
 *
 * @author  geniv
 * @package Macros
 */
class MacroIfCurrentSwitch extends MacroSet
{

    /**
     * Register latte macros.
     *
     * @param Compiler $compiler
     */
    public static function install(Compiler $compiler)
    {
        $me = new static($compiler);
        $me->addMacro('ifCurrentSwitch', 'if (FALSE) {', '}');
        $me->addMacro('ifCurrentCase', '} elseif ($presenter->isLinkCurrent(%node.args)) {');
        $me->addMacro('ifCurrentDefault', '} else {');
    }


//    /**
//     * @param MacroNode $node
//     * @param PhpWriter $writer
//     * @return string
//     */
//    public function macroIfCurrentSwitch(MacroNode $node, PhpWriter $writer)
//    {
//        return $writer->write('foreach (%node.array as $l) { if ($presenter->isLinkCurrent($l)) { $_c = true; break; }} if (isset($_c)): ');
//    }
//
//
//    /**
//     * @param MacroNode $node
//     * @param PhpWriter $writer
//     * @return string
//     */
//    public function macroIfCurrentSwitchEnd(MacroNode $node, PhpWriter $writer)
//    {
//        return $writer->write('endif; unset($_c);');
//    }
}
