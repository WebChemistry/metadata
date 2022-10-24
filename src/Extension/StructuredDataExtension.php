<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\BreadcrumbMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class StructuredDataExtension implements MetadataExtensionInterface
{

	public function __construct(
		private BreadcrumbMetadata $breadcrumbMetadata,
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
		$this->createBreadcrumb($wrapper);
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

	private function createBreadcrumb(Wrapper $wrapper): void
	{
		$items = $this->breadcrumbMetadata->getItems();

		if (!$items) {
			return;
		}

		$list = [];

		$pos = 1;
		foreach ($items as $name => $link) {
			$list[] = [
				'@type' => 'ListItem',
				'position' => $pos++,
				'name' => $name,
				'item' => $link,
			];
 		}

		// https://developers.google.com/search/docs/advanced/structured-data/breadcrumb
		$this->toJsonLd($wrapper, [
			'@context' => 'https://schema.org',
			'@type' => 'BreadcrumbList',
			'itemListElement' => $list,
		]);
	}

	private function toJsonLd(Wrapper $wrapper, array $array): void
	{
		$wrapper->add('script', [
			'type' => 'application/ld+json',
		], html: MetadataUtility::escapeJs($array));
	}

}
