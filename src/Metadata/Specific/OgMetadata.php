<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific;

use InvalidArgumentException;

final class OgMetadata
{

	private ?string $link = null;

	/** @var mixed[] */
	private array $images = [];

	public function __construct(
		mixed $image = null,
	)
	{
		$this->setImage($image);
	}

	public function setImage(?string $image): self
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
