<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific;

use InvalidArgumentException;
use Nette\Utils\Strings;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class BasicMetadata
{

	/** @var array<string, bool> */
	private array $robots = [
		'noindex' => false,
		'nofollow' => false,
	];

	private ?string $titleTemplate;

	public function __construct(
		private ?string $title = null,
		private ?string $description = null,
		private ?string $author = null,
		private ?string $lang = null,
		private ?string $color = null,
		?string $titleTemplate = null,
	)
	{
		$this->setTitleTemplate($titleTemplate);
	}

	public function setColor(?string $color): self
	{
		$this->color = $color;

		return $this;
	}

	public function getColor(): ?string
	{
		return $this->color;
	}

	public function setLang(?string $lang): void
	{
		$this->lang = $lang;
	}

	public function setTitle(?string $title): self
	{
		$this->title = MetadataUtility::normalize($title);

		return $this;
	}

	public function setTitleTemplate(?string $titleTemplate): void
	{
		if ($titleTemplate === null) {
			$titleTemplate = '%s';

		} else if (!str_contains($titleTemplate, '%s')) {
			throw new InvalidArgumentException('Title template must contains %s');

		}

		$this->titleTemplate = $titleTemplate;
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
	 * @return array<string, bool>
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

	public function getLang(): ?string
	{
		return $this->lang;
	}

}
