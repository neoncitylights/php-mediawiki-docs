<?php

namespace Neoncitylights\MediaWikiDocs\Services;

use Roave\BetterReflection\BetterReflection;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflector\DefaultReflector;
use Roave\BetterReflection\SourceLocator\Type\DirectoriesSourceLocator;

/**
 * @license MIT
 */
class HookDataStore {
	private HookDirectoryStore $hookDirectoryStore;
	/** @var ReflectionClass[] */
	private array $classes;

	public function __construct( HookDirectoryStore $hookDirectoryStore ) {
		$this->hookDirectoryStore = $hookDirectoryStore;
		$this->classes = [];
	}

	/**
	 * @return ReflectionClass[]
	 */
	public function loadHookData(): array {
		if ( count( $this->classes ) !== 0 ) {
			return $this->classes;
		}

		$astLocator = ( new BetterReflection() )->astLocator();
		$directoriesSourceLocator = new DirectoriesSourceLocator(
			$this->hookDirectoryStore->loadHookDirectories(),
			$astLocator
		);

		$reflector = new DefaultReflector( $directoriesSourceLocator );
		$this->classes = $reflector->reflectAllClasses();

		return $this->classes;
	}

	/**
	 * Clears the cached list of hooks
	 */
	public function clear(): void {
		$this->classes = [];
	}
}
