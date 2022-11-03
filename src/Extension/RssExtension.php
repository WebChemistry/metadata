<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\RssMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class RssExtension implements MetadataExtensionInterface
{

	public function __construct(
		private RssMetadata $rssMetadata,
	)
	{
	}

	public function htmlAttributes(): array
	{
		return [];
	}

	public function head(Wrapper $wrapper): void
	{
		if ($link = $this->rssMetadata->getLink()) {
			$wrapper->add('link', [
				'rel' => 'alternate',
				'type' => 'application/rss+xml',
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
