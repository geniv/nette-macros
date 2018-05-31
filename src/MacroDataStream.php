<?php

namespace Macros;

use Latte;
use Latte\CompileException;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;


/**
 * Class MacroDataStream
 *
 * @author  geniv
 * @package Macros
 */
class MacroDataStream extends MacroSet
{

    /**
     * Install.
     *
     * @param Latte\Compiler $compiler
     */
    public static function install(Latte\Compiler $compiler)
    {
        $me = new static($compiler);
        $me->addMacro('dataStream', [$me, 'macroDataStream'], [$me, 'macroDataStream']);
    }


    /**
     * Macro dataStream.
     *
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     * @throws CompileException
     */
    public function macroDataStream(MacroNode $node, PhpWriter $writer)
    {
        if ($node->modifiers) {
            throw new CompileException('Modifiers are not allowed in ' . $node->getNotation());
        }
        $node->openingCode = '<?php ob_start(function () {}) ?>';
        $node->closingCode = '<?php $_fi=__DIR__."/../../../".ob_get_clean(); echo (file_exists($_fi) ? Latte\\Runtime\\Filters::dataStream(file_get_contents($_fi)) : null); ?>';
    }
}
