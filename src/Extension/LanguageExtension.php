<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\LanguageMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class LanguageExtension implements MetadataExtensionInterface
{

	public function __construct(
		private LanguageMetadata $languageMetadata,
	)
	{
	}

	/**
	 * @return array<string, string>
	 */
	public function htmlAttributes(): array
	{
		$attributes = [];

		if ($lang = $this->languageMetadata->getLang()) {
			$attributes['lang'] = $lang;
		}

		return $attributes;
	}

	public function head(Wrapper $wrapper): void
	{
		foreach ($this->languageMetadata->getAlternates() as $lang => $link) {
			$wrapper->add('link', [
				'rel' => 'alternate',
				'hreflang' => $lang,
				'href' => $link,
			]);
		}
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
