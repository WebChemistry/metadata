<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class FaviconMetadata
{

	public function __construct(
		private ?string $icon = null,
		private ?string $type = null,
	)
	{
	}

	public function getIcon(): ?string
	{
		return $this->icon;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

}
