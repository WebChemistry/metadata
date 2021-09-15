<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class ColorMetadata
{

	public function __construct(
		private ?string $color = null,
	)
	{
	}

	public function getColor(): ?string
	{
		return $this->color;
	}

}
