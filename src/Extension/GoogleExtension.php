<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\GoogleMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class GoogleExtension implements MetadataExtensionInterface
{

	public function __construct(
		private GoogleMetadata $googleMetadata,
	)
	{
	}

	public function head(Wrapper $wrapper): void
	{
		$wrapper->addMetaWithName('google-site-verification', $this->googleMetadata->getVerification());

		if ($analytics = $this->googleMetadata->getAnalytics()) {
			$wrapper->addHtmlFromTemplate(__DIR__ . '/templates/google-analytics.html', ['id' => $analytics]);
		}
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
