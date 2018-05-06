<?php

namespace Macros;

use Latte\CompileException;
use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;


/**
 * Class MacroIfCurrent
 *
 * @author  geniv
 * @package Macros
 */
class MacroIfCurrent extends MacroSet
{

    /**
     * Install.
     *
     * @param Compiler $compiler
     */
    public static function install(Compiler $compiler)
    {
        $me = new static($compiler);
        $me->addMacro('ifCurrent', [$me, 'macroIfCurrent'], '}'); // deprecated; use n:class="$presenter->linkCurrent ? ..."

        $me->addMacro('ifCurrentIn', [$me, 'macroIfCurrentIn'], [$me, 'macroIfCurrentInEnd']);

        $me->addMacro('ifCurrentSwitch', 'if (FALSE) {', '}');
        $me->addMacro('ifCurrentCase', '} elseif ($presenter->isLinkCurrent(%node.args)) {');
        $me->addMacro('ifCurrentDefault', '} else {');
    }


    /**
     * {ifCurrent destination [,] [params]}
     *
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     * @throws CompileException
     */
    public function macroIfCurrent(MacroNode $node, PhpWriter $writer)
    {
        if ($node->modifiers) {
            throw new CompileException('Modifiers are not allowed in ' . $node->getNotation());
        }
        return $writer->write($node->args
            ? 'if ($this->global->uiPresenter->isLinkCurrent(%node.word, %node.array?)) {'
            : 'if ($this->global->uiPresenter->getLastCreatedRequestFlag("current")) {'
        );
    }


    /**
     * Macro ifCurrentIn.
     *
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     */
    public function macroIfCurrentIn(MacroNode $node, PhpWriter $writer)
    {
        return $writer->write('foreach (%node.array as $l) { if ($presenter->isLinkCurrent($l)) { $_c = true; break; }} if (isset($_c)): ');
    }


    /**
     * Macro ifCurrentIn end.
     *
     * @param MacroNode $node
     * @param PhpWriter $writer
     * @return string
     */
    public function macroIfCurrentInEnd(MacroNode $node, PhpWriter $writer)
    {
        return $writer->write('endif; unset($_c);');
    }
}
