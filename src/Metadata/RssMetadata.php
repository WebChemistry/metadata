<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class RssMetadata
{

	public function __construct(
		private ?string $link = null,
	)
	{
	}

	public function getLink(): ?string
	{
		return $this->link;
	}

	public function setLink(?string $link): void
	{
		$this->link = $link;
	}

}
