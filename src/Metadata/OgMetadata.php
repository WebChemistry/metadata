<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class OgMetadata
{

	private ?string $link = null;

	public function __construct(
		private mixed $image = null,
	)
	{
	}

	public function setImage(mixed $image): self
	{
		$this->image = $image;

		return $this;
	}

	public function setLink(?string $link): self
	{
		$this->link = $link;

		return $this;
	}

	public function getImage(): mixed
	{
		return $this->image;
	}

	public function getLink(): ?string
	{
		return $this->link;
	}

}
