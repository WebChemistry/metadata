<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

use WebChemistry\Metadata\Metadata\Values\FaviconIcon;

final class FaviconMetadata
{

	/** @var FaviconIcon[] */
	private array $icons = [];

	public function __construct(
		private ?string $manifest,
	)
	{
	}

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

	public function getManifest(): ?string
	{
		return $this->manifest;
	}

}
