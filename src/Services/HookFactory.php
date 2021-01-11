<?php

namespace Neoncitylights\MediaWikiDocs\Services;

use Neoncitylights\MediaWikiDocs\Objects\Hook;
use Neoncitylights\MediaWikiDocs\Objects\HookMethod;
use Neoncitylights\MediaWikiDocs\Objects\HookParameter;
use Neoncitylights\MediaWikiDocs\Objects\VersionInfo;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use phpDocumentor\Reflection\DocBlockFactory;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflection\ReflectionMethod;

/**
 * @license MIT
 */
class HookFactory {
	private DocBlockFactory $docBlockFactory;

	public function __construct( DocBlockFactory $docBlockFactory ) {
		$this->docBlockFactory = $docBlockFactory;
	}

	public function getHookFromReflectionClass( ReflectionClass $hook ) : Hook {
		/** @var ReflectionMethod */
		$hookMethod = $hook->getMethods()[0];
		$hookMethodName = $hookMethod->getName();
		$hookMethodDoc = $this->docBlockFactory->create( $hookMethod->getDocComment() );
		$hookDescription = $hookMethodDoc->getSummary() ?? 'test';

		$versionIntroduced = '';
		$versionDeprecated = null;
		$hookParams = [];
		foreach ( $hookMethodDoc->getTags() as $tag ) {
			if ( $tag instanceof Since ) {
				$versionIntroduced = $tag->getVersion();
			}

			if ( $tag instanceof Deprecated ) {
				$versionDeprecated = $tag->getVersion();
			}

			if ( $tag instanceof Param ) {
				$hookParams[] = new HookParameter(
					$tag->getType(),
					$tag->getVariableName(),
					$tag->getDescription() ?? ''
				);
			}
		}

		return new Hook(
			$this->getUsableHookName( $hook ) ?? '',
			$hook->getName(),
			$hook->getFileName(),
			$hookDescription,
			new VersionInfo(
				$versionIntroduced,
				$versionDeprecated
			),
			new HookMethod(
				$hookMethodName,
				$hookParams
			)
		);
	}

	private function getUsableHookName( ReflectionClass $hook ) : string {
		$hookInterfaceDoc = $this->docBlockFactory->create( $hook->getDocComment() );
		$hookDescription = $hookInterfaceDoc->getDescription()->render();

		$matches = [];
		$doesMatch = preg_match(
			"/Use the hook name \"([A-Za-z:]+)\" to register handlers implementing this interface./",
			$hookDescription,
			$matches
		);

		if ( $doesMatch > 0 ) {
			return $matches[1];
		} else {
			return HookUtils::normalizeFromClassName( $hook->getShortName() );
		}
	}
}
