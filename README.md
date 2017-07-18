Macros
======
Latte macros

macros:
    IfCurrentIn: true
    SubmitButton: true
    Confirm: true
    


latte:
	#xhtml: no  # výchozi je false
	macros:
		- LatteMacroIfCurrentIn
		- ButtonMacros



Macros\Bridges\Nette\Extension


<div n:ifCurrentIn="'News:default', 'Homepage:default'">Hello, n:macro</div>
{ifCurrentIn "News:default", "Homepage:default"}Hello, standart macro{/ifCurrentIn}


{form formName}
	{button controlName class=>"btn"}
		<i class="icon icon-ok"></i>
		{caption}
	{/button}
{/form}



{form formName}
	{button $_form['controlName'] class=>"btn"}
		<i class="icon icon-ok"></i>
		{caption}
	{/button}
{/form}



----
nette:
    latte:
        macros:
            - CustomMacros::install
