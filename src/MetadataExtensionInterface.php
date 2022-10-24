<?php declare(strict_types = 1);

namespace WebChemistry\Metadata;

use WebChemistry\Metadata\Html\Wrapper;

interface MetadataExtensionInterface
{

	/**
	 * @return array<string, string>
	 */
	public function htmlAttributes(): array;

	public function head(Wrapper $wrapper): void;

	public function body(Wrapper $wrapper): void;

	public function footer(Wrapper $wrapper): void;

}
