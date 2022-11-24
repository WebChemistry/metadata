<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\StructuredDataMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class StructuredDataExtension implements MetadataExtensionInterface
{

	public function __construct(
		private StructuredDataMetadata $structuredDataMetadata,
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
		foreach ($this->structuredDataMetadata->getItems() as $item) {
			$this->toJsonLd($wrapper, $item->toJson());
		}
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

	private function toJsonLd(Wrapper $wrapper, array $array): void
	{
		$wrapper->add('script', [
			'type' => 'application/ld+json',
		], html: MetadataUtility::escapeJs($array));
	}

}
