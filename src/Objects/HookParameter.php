<?php

namespace Neoncitylights\MediaWikiDocs\Objects;

/**
 * @license MIT
 */
class HookParameter {
	private string $name;
	private string $types;
	private string $description;

	public function __construct( string $types, string $name, string $description ) {
		$this->types = $types;
		$this->name = $name;
		$this->parameters = $description;
	}

	public function getTypes() : string {
		return $this->types;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getDescription() : string {
		return $this->description;
	}

	public function getAsTypedString() : string {
		return "{$this->types} \${$this->name}";
	}
}
