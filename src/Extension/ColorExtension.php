<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\ColorMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class ColorExtension implements MetadataExtensionInterface
{

	public function __construct(
		private ColorMetadata $colorMetadata,
	)
	{
	}

	/**
	 * @return array<string, string>
	 */
	public function htmlAttributes(): array
	{
		return [];
	}

	public function head(Wrapper $wrapper): void
	{
		$color = $this->colorMetadata->getColor();

		if ($color) {
			$wrapper->addMetaWithName('theme-color', $color);
			$wrapper->addMetaWithName('msapplication-navbutton-color', $color);
			$wrapper->addMetaWithName('apple-mobile-web-app-capable', 'yes');
			$wrapper->addMetaWithName('apple-mobile-web-app-status-bar-style', $color);
		}
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
