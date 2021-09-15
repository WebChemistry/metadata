<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\BasicMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class BasicExtension implements MetadataExtensionInterface
{

	public function __construct(
		private BasicMetadata $basicMetadata,
	)
	{
	}

	public function head(Wrapper $wrapper): void
	{
		$wrapper->add('meta', ['charset' => 'utf-8']);
		$wrapper->add('meta', ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1']);
		$wrapper->addMetaWithName('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');

		if ($title = $this->basicMetadata->getTitle()) {
			$wrapper->add('title', text: $title);
		}

		$robots = implode(' ', array_keys(array_filter($this->basicMetadata->getRobots())));

		$wrapper->addMetaWithName('description', $this->basicMetadata->getDescription());
		$wrapper->addMetaWithName('author', $this->basicMetadata->getAuthor());
		$wrapper->addMetaWithName('robots', $robots);
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
