<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette;

use WebChemistry\Metadata\Metadata\BasicMetadata;
use WebChemistry\Metadata\Metadata\LanguageMetadata;
use WebChemistry\Metadata\Metadata\OgMetadata;

trait TMetadataPresenter
{

	private MetadataComponentFactory $metaComponentFactory;

	protected BasicMetadata $basicMetadata;

	protected OgMetadata $ogMetadata;

	protected LanguageMetadata $languageMetadata;

	final public function injectMetadata(
		BasicMetadata $basicMetadata,
		OgMetadata $ogMetadata,
		LanguageMetadata $languageMetadata,
		MetadataComponentFactory $metadataComponentFactory,
	): void
	{
		$this->basicMetadata = $basicMetadata;
		$this->ogMetadata = $ogMetadata;
		$this->languageMetadata = $languageMetadata;
		$this->metaComponentFactory = $metadataComponentFactory;
	}

	protected function createComponentMeta(): MetadataComponent
	{
		return $this->metaComponentFactory->create();
	}

}
