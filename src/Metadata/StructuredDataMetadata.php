<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

use WebChemistry\Metadata\StructuredData\StructuredData;

final class StructuredDataMetadata
{

	/** @var StructuredData[] */
	private array $items = [];

	public function addItem(StructuredData $structuredData): self
	{
		$this->items[] = $structuredData;

		return $this;
	}

	/**
	 * @return StructuredData[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

}
