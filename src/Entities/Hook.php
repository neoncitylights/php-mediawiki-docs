<?php

namespace Neoncitylights\MediaWikiDocs\Entities;

/**
 * @license MIT
 */
class Hook {
	private string $usableName;
	private string $fullyQualifiedClassName;
	private string $filePathName;
	private string $description;
	private VersionInfo $versionInfo;
	private HookMethod $method;

	public function __construct(
		string $usableName,
		string $fullyQualifiedClassName,
		string $filePathName,
		string $description,
		VersionInfo $versionInfo,
		HookMethod $method
	) {
		$this->usableName = $usableName;
		$this->fullyQualifiedClassName = $fullyQualifiedClassName;
		$this->filePathName = $filePathName;
		$this->description = $description;
		$this->versionInfo = $versionInfo;
		$this->method = $method;
	}

	public function getUsableName(): string {
		return $this->usableName;
	}

	public function getFullyQualifiedClassName(): string {
		return $this->fullyQualifiedClassName;
	}

	public function getFilePathName(): string {
		return $this->filePathName;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function getVersionInfo(): VersionInfo {
		return $this->versionInfo;
	}

	public function getMethod(): HookMethod {
		return $this->method;
	}
}
