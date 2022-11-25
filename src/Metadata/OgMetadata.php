<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

use InvalidArgumentException;

final class OgMetadata
{

	private ?string $link = null;

	/** @var mixed[] */
	private array $images = [];

	public function __construct(
		mixed $image = null,
		private ?string $siteName = null,
	)
	{
		$this->setImage($image);
	}

	public function setSiteName(?string $siteName): self
	{
		$this->siteName = $siteName;

		return $this;
	}

	public function getSiteName(): ?string
	{
		return $this->siteName;
	}

	public function setImage(mixed $image): self
	{
		if (!is_string($image) && !is_object($image) && $image !== null) {
			throw new InvalidArgumentException(
				sprintf('Image must be an string or object or null, %s given.', get_debug_type($image))
			);
		}

		if ($image) {
			array_unshift($this->images, $image);
		}

		return $this;
	}

	public function setLink(?string $link): self
	{
		$this->link = $link;

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function getImages(): array
	{
		return $this->images;
	}

	public function getLink(): ?string
	{
		return $this->link;
	}

}
