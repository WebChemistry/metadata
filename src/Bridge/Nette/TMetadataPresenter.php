<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette;

use WebChemistry\Metadata\Metadata\BasicMetadata;
use WebChemistry\Metadata\Metadata\OgMetadata;

trait TMetadataPresenter
{

	private MetadataComponentFactory $metaComponentFactory;

	protected BasicMetadata $basicMetadata;

	protected OgMetadata $ogMetadata;

	final public function injectMetadata(BasicMetadata $basicMetadata, OgMetadata $ogMetadata, MetadataComponentFactory $metadataComponentFactory): void
	{
		$this->basicMetadata = $basicMetadata;
		$this->ogMetadata = $ogMetadata;
		$this->metaComponentFactory = $metadataComponentFactory;
	}

	protected function createComponentMeta(): MetadataComponent
	{
		return $this->metaComponentFactory->create();
	}

}
