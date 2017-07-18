<?php

namespace Macros;

use Nette\Latte\Macros\MacroSet;
use Nette\Latte\PhpWriter;
use Nette\Latte\MacroNode;
use Nette\Latte\Compiler;


/**
 * Class MacroConfirm
 *
 * @author  geniv, inspirated by Jan Brabec
 * @package Macros
 */
class MacroConfirm extends MacroSet
{

    /**
     * Register latte macros.
     *
     * @param Compiler $compiler
     */
    public static function install(Compiler $compiler)
    {
        $me = new static($compiler);
        $me->addMacro('confirm', NULL, NULL, array($me, 'macroAttrLinkConfirm'));
    }


    /**
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     */
    public function macroAttrLinkConfirm(MacroNode $node, PhpWriter $writer)
    {
        return $writer->write('?> onclick="return confirm(\'<?php echo %escape("' . $node->args . '")?>\');" <?php');
    }
}
