<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Values;

final class FaviconIcon
{

	public function __construct(
		private string $link,
		private ?string $type,
		private ?string $sizes,
		private string $rel = 'icon',
	)
	{
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function getSizes(): ?string
	{
		return $this->sizes;
	}

	public function getRel(): string
	{
		return $this->rel;
	}

}
