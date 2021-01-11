<?php

namespace Neoncitylights\MediaWikiDocs\Objects;

/**
 * @license MIT
 */
class HookMethod {
	/** @var string Name of method */
	private string $name;

	/** @var HookParameter[] */
	private array $parameters;

	/**
	 * @param string $name
	 * @param HookParameter[] $parameters
	 */
	public function __construct( string $name, array $parameters ) {
		$this->name = $name;
		$this->parameters = $parameters;
	}

	/**
	 * @return string
	 */
	public function getName() : string {
		return $this->name;
	}

	/**
	 * @return HookParameter[]
	 */
	public function getParameters() : array {
		return $this->parameters;
	}

	/**
	 * @return string
	 */
	public function getAsInterfaceMethod() : string {
		$parameters = [];
		foreach( $this->parameters as $parameter ) {
			$parameters[] = $parameter->getAsTypedString();
		}

		return sprintf(
			"public function %s( %s );",
			$this->name,
			implode(", ", $parameters )
		);
	}

	/**
	 * @return string
	 */
	public function getAsTypedStaticMethod() : string {
		$parameters = [];
		foreach( $this->parameters as $parameter ) {
			$parameters[] = $parameter->getAsTypedString();
		}

		return sprintf(
			"public static function %s( %s ) {}",
			$this->name,
			implode(", ", $parameters )
		);
	}
}
