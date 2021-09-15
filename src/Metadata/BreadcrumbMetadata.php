<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class BreadcrumbMetadata
{

	/** @var array<string, string> name => link */
	private array $items = [];

	public function addItem(string $name, string $link): self
	{
		$this->items[$name] = $link;

		return $this;
	}

	/**
	 * @return array<string, string> name => link
	 */
	public function getItems(): array
	{
		return $this->items;
	}

}
