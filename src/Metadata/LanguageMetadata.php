<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class LanguageMetadata
{

	/** @var array<string, string> */
	private array $alternates = [];

	public function __construct(
		private ?string $lang = null,
	)
	{
	}

	public function getLang(): ?string
	{
		return $this->lang;
	}

	public function setLang(?string $lang): self
	{
		$this->lang = $lang;

		return $this;
	}

	public function addAlternate(string $lang, string $link): self
	{
		$this->alternates[$lang] = $link;

		return $this;
	}

	/**
	 * @return array<string, string>
	 */
	public function getAlternates(): array
	{
		return $this->alternates;
	}

}
