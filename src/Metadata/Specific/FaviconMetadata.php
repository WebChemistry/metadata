<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific;

use WebChemistry\Metadata\Metadata\Specific\Argument\FaviconIcon;

final class FaviconMetadata
{

	/** @var FaviconIcon[] */
	private array $icons = [];

	public function addIcon(string $link, ?string $type, ?string $sizes, string $rel = 'icon'): self
	{
		$this->icons[] = new FaviconIcon($link, $type, $sizes, $rel);

		return $this;
	}

	/**
	 * @return FaviconIcon[]
	 */
	public function getIcons(): array
	{
		return $this->icons;
	}

}
