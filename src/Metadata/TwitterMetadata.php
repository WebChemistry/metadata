<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class TwitterMetadata
{

	public function __construct(
		private ?string $site = null,
	)
	{
	}

	public function getSite(): ?string
	{
		return $this->site;
	}

}
