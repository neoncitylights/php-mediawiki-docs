<?php

namespace Neoncitylights\MediaWikiDocs\Services;

/**
 * @license MIT
 */
class HookUtils {
	public static function normalizeFromClassName( string $className ): string {
		$normalized = '';
		$normalized = str_replace( '_', ':', $className );
		$normalized = str_replace( 'Hook', '', $className );

		return $normalized;
	}
}
