<?php

namespace Neoncitylights\MediaWikiDocs\Services;

/**
 * @license MIT
 */
class HookDirectoryStore {
	private string $basePath;
	/** @var string[] */
	private array $hookDirectories;

	/**
	 * @param string $basePath absolute path to root of MediaWiki instance
	 */
	public function __construct( string $basePath ) {
		$this->basePath = $basePath;
		$this->hookDirectories = [];
	}

	/**
	 * Returns a cached list of every hook directory in MediaWiki, as an abosolute path
	 * @return string[] A list of absolute paths to hook directories
	 */
	public function loadHookDirectories() : array {
		if ( count( $this->hookDirectories ) !== 0 ) {
			return $this->hookDirectories;
		}

		$this->hookDirectories = [ "{$this->basePath}/includes/Hook/" ];
		$this->hookDirectories = array_merge(
			$this->hookDirectories,
			glob( "{$this->basePath}/includes/*/Hook/", GLOB_ONLYDIR )
		);

		sort( $this->hookDirectories );
		return $this->hookDirectories;
	}

	public function clear(): void {
		$this->hookDirectories = [];
	}
}
