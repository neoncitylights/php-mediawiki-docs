# php-mediawiki-docs
`neoncitylights/mediawiki-docs` is an experimental static analayis tool that allows auto-generating documentation of hooks.
It is currently experimental, and thus the public API may be changed at any time, until a stable version releases.

## Software requirements
* MediaWiki: master branch (**NOTE**: the MediaWiki core software only needs to exist in the file system)
* PHP: 8.0+

## Usage
The following example will generate text in Markdown, showing a list of hook names to their static method signature.
The following Gist link is generated using the code below: https://gist.github.com/neoncitylights/27c05b3ab2d49e16907bc8b0322740dc

```php
<?php
use Neoncitylights\MediaWikiDocs\Services\HookDataStore;
use Neoncitylights\MediaWikiDocs\Services\HookDirectoryStore;
use Neoncitylights\MediaWikiDocs\Services\HookFactory;
use phpDocumentor\Reflection\DocBlockFactory;

$includePath = __DIR__ . '/mediawiki';
$hookDirectoryStore = new HookDirectoryStore( $includePath );
$hookDataStore = new HookDataStore( $hookDirectoryStore );
$hookFactory = new HookFactory( DocBlockFactory::createInstance() );

$classes = $hookDataStore->loadHookData();

$hookNames = [];
foreach( $classes as $class ) {
	$hook = $hookFactory->getHookFromReflectionClass( $class );
	$hookNames[$hook->getUsableName()] = "* `{$hook->getUsableName()}`: " .
	"\n```php\n{$hook->getMethod()->getAsTypedStaticMethod()}\n```";
}

natcasesort( $hookNames );
echo "<pre>";
echo implode( "<br>", $hookNames );
echo "</pre>";
```
