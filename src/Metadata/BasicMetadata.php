<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

use InvalidArgumentException;
use Nette\Utils\Strings;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class BasicMetadata
{

	private array $robots = [
		'noindex' => false,
		'nofollow' => false,
	];

	public function __construct(
		private ?string $title = null,
		private ?string $description = null,
		private ?string $author = null,
		private ?string $titleTemplate = null,
	)
	{
		$this->titleTemplate = $this->titleTemplate ?: '%s';

		if (!str_contains($this->titleTemplate, '%s')) {
			throw new InvalidArgumentException('Title template must contains %s');
		}
	}

	public function setTitle(?string $title): self
	{
		$this->title = MetadataUtility::normalize($title);

		return $this;
	}

	public function addToTitle(?string $title): self
	{
		if (!$title) {
			return $this;
		}

		$this->title = sprintf($this->titleTemplate, MetadataUtility::normalize($title));

		return $this;
	}

	public function setAuthor(?string $author): self
	{
		$this->author = MetadataUtility::normalize($author);

		return $this;
	}

	public function setDescription(?string $description): self
	{
		$this->description = MetadataUtility::truncate($description, 200);

		return $this;
	}

	public function setNoFollow(): self
	{
		$this->robots['nofollow'] = true;

		return $this;
	}

	public function setNoIndex(): self
	{
		$this->robots['noindex'] = true;

		return $this;
	}

	/**
	 * @return bool[]
	 */
	public function getRobots(): array
	{
		return $this->robots;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function getAuthor(): ?string
	{
		return $this->author;
	}

}
