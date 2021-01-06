# php-mediawiki-docs
`neoncitylights/mediawiki-docs` is an experimental static analayis tool that allows auto-generating documentation of hooks.
It is currently experimental, and thus the public API may be changed at any time, until a stable version releases.

## Software requirements
* MediaWiki: master branch (**NOTE**: the MediaWiki core software only needs to exist in the file system)
* PHP: 7.4.0+

## Usage
```php
use Neoncitylights\MediaWikiDocs\Services\HookDataStore;
use Neoncitylights\MediaWikiDocs\Services\HookDirectoryStore;
use Neoncitylights\MediaWikiDocs\Services\HookFactory;
use phpDocumentor\Reflection\DocBlockFactory;

$mediaWikiPath = __DIR__ . '/mediawiki';
$hookDirectoryStore = new HookDirectoryStore( $mediaWikiPath );
$hookDataStore = new HookDataStore( $hookDirectoryStore );
$hookFactory = new HookFactory( DocBlockFactory::createInstance() );

$classes = $hookDataStore->loadHookData();

$hookNames = [];
foreach( $classes as $class ) {
	$hook = $hookFactory->getHookFromReflectionClass( $class );
	$hookNames[] = "`{$hook->getName()}`: " . $hook->getDescription();
}

natcasesort( $hookNames );
echo implode( "<br> * ", $hookNames );
```
