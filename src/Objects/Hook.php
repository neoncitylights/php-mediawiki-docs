<?php

namespace Neoncitylights\MediaWikiDocs\Objects;

/**
 * @license MIT
 */
class Hook {
	private string $name;
	private string $description;
	private VersionInfo $versionInfo;
	private HookMethod $method;

	/**
	 * @param string $name
	 * @param string $description
	 * @param VersionInfo $versionInfo
	 * @param HookMethod $method
	 */
	public function __construct(
		string $name,
		string $description,
		VersionInfo $versionInfo,
		HookMethod $method
	) {
		$this->name = $name;
		$this->description = $description;
		$this->versionInfo = $versionInfo;
		$this->method = $method;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getDescription() : string {
		return $this->description;
	}

	public function getVersionInfo() : VersionInfo {
		return $this->versionInfo;
	}

	public function getMethod() : HookMethod {
		return $this->method;
	}
}
