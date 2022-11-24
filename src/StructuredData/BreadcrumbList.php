<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData;

use Nette\Utils\Arrays;

final class BreadcrumbList implements StructuredData
{

	/** @var array{string, string}[] */
	private array $items = [];

	public function addItem(string $name, string $link): self
	{
		$this->items[] = [$name, $link];

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function toJson(): array
	{
		return [
			'@context' => 'https://schema.org',
			'@type' => 'BreadcrumbList',
			'itemListElement' => Arrays::map(
				$this->items,
				fn (array $item, int $key) => [
					'@type' => 'ListItem',
					'position' => $key + 1,
					'name' => $item[0],
					'item' => $item[1],
				],
			),
		];
	}

}
