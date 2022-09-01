<?php

namespace Neoncitylights\MediaWikiDocs\Entities;

/**
 * @license MIT
 */
class VersionInfo {
	private string $versionIntroduced;
	private ?string $versionDeprecated;
	private bool $isDeprecated;

	public function  __construct(
		string $versionIntroduced,
		?string $versionDeprecated = null
	) {
		$this->versionIntroduced = $versionIntroduced;
		$this->versionDeprecated = $versionDeprecated;
		$this->isDeprecated = $versionDeprecated != null ? true : false;
	}

	public function getVersionIntroduced(): string {
		return $this->versionIntroduced;
	}

	public function getVersionDeprecated(): ?string {
		return $this->versionDeprecated;
	}

	public function isDeprecated(): bool {
		return $this->isDeprecated;
	}
}
