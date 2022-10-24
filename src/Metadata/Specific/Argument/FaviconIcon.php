<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific\Argument;

final class FaviconIcon
{

	/** @var FaviconIcon[] */
	private array $icons = [];

	public function addIcon(string $link, ?string $type, ?string $sizes, string $rel = 'icon'): static
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
