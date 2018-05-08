<?php

namespace Macros;

use Latte\CompileException;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;
use Latte\MacroNode;
use Latte\Compiler;


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
        $me->addMacro('confirm', null, null, [$me, 'macroConfirm']);
    }


    /**
     * Macro confirm.
     *
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     * @throws CompileException
     */
    public function macroConfirm(MacroNode $node, PhpWriter $writer)
    {
        if ($node->modifiers) {
            throw new CompileException('Modifiers are not allowed in ' . $node->getNotation());
        }
        return $writer->write('echo " onclick=\"return confirm(\'" . %escape(%node.args) . "\')\""');
    }
}
