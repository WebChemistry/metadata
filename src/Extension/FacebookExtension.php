<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\FacebookMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class FacebookExtension implements MetadataExtensionInterface
{

	public function __construct(
		private FacebookMetadata $facebookMetadata,
	)
	{
	}

	/**
	 * @return array<string, string>
	 */
	public function htmlAttributes(): array
	{
		return [];
	}

	public function head(Wrapper $wrapper): void
	{
		$wrapper->addMetaWithName('facebook-domain-verification', $this->facebookMetadata->getVerification());

		if ($pixel = $this->facebookMetadata->getPixel()) {
			$wrapper->addHtmlFromTemplate(__DIR__ . '/templates/facebook-pixel.html', ['id' => $pixel]);
		}
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
