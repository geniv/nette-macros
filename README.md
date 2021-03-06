Macros
======
Latte macros

Installation
------------

```sh
$ composer require geniv/nette-macros
```
or
```json
"geniv/nette-macros": ">=1.0.0"
```

require:
```json
"php": ">=5.6.0",
"nette/nette": ">=2.4.0"
```

Include in application
----------------------

neon configure:
```neon
extensions:
    - Macros\Bridges\Nette\Extension
```

IfCurrent (n:class="$presenter->linkCurrent ? ..."):
```latte
<div n:ifCurrent="Homepage:default">aktivni sekce Homepage:default</div>
{ifCurrent 'Homepage:default'}aktivni sekce Homepage:default{/ifCurrent}
```

IfCurrentIn:
```latte
<div n:ifCurrentIn="'News:default', 'Homepage:default'">Hello, n:macro</div>
{ifCurrentIn 'News:default', 'Homepage:default'}Hello, standart macro{/ifCurrentIn}
```

IfCurrentSwitch:
```latte
{ifCurrentSwitch}
    {ifCurrentCase 'Homepage:default'}
        layout-variant-hp
    {ifCurrentCase 'Homepage:vzor'}
        layout-variant-location
    {ifCurrentDefault}
        layout-variant-sub
{/ifCurrentSwitch}
```

SubmitButton:
```latte
{form formName}
    {button controlName, class=>"btn"}
        <i class="icon icon-ok"></i>
        {caption}
    {/button}
{/form}

{form formName}
	{button $_form['controlName'], class=>"btn"}
		<i class="icon icon-ok"></i>
		{caption}
	{/button}
{/form}
```

Confirm:
```latte
<a href="..." n:confirm="'Really delete?'">delete</a>
<a href="..." n:confirm="$presenter->translator->translate('translate-confirm')">delete</a>
```

DataStream:
```latte
{dataStream}/www/images/logo.png{/dataStream}
```

_if image does not exist then result null_
