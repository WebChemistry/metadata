<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData;

use DateTimeInterface;
use WebChemistry\Metadata\StructuredData\Part\PaywallPart;

final class NewsArticle implements StructuredData
{

	/** @var mixed[] */
	private array $data;

	private ?PaywallPart $paywallPart = null;

	private ?Person $author = null;

	public function __construct(
		string $headline,
		DateTimeInterface $published,
	)
	{
		$this->data = [
			'@context' => 'https://schema.org',
			'@type' => 'NewsArticle',
			'headline' => $headline,
			'datePublished' => $published->format('c'),
			'dateModified' => $published->format('c'),
		];
	}

	public function setDescription(?string $description): self
	{
		$this->data['description'] = $description;

		return $this;
	}

	public function setPaywall(?PaywallPart $paywallPart): self
	{
		$this->paywallPart = $paywallPart;

		return $this;
	}

	public function setAuthor(?Person $author): self
	{
		$this->author = $author;

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function toJson(): array
	{
		$data = array_merge(
			$this->data,
			$this->paywallPart?->toJson() ?? [],
		);

		if ($author = $this->author) {
			$data['author'] = $author->toJson();
		}

		return array_filter(
			$data,
			fn (mixed $value): bool => $value !== null,
		);
	}

}
