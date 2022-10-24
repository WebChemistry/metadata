<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use Nette\Http\IRequest;
use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\FaviconMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class FaviconExtension implements MetadataExtensionInterface
{

	public function __construct(
		private FaviconMetadata $faviconMetadata,
		private IRequest $request,
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
		foreach ($this->faviconMetadata->getIcons() as $icon) {
			$wrapper->add('link', [
				'rel' => $icon->getRel(),
				'href' => MetadataUtility::replaceUrlVariables($icon->getLink(), $this->request),
				'type' => $icon->getType(),
				'sizes' => $icon->getSizes(),
			]);
		}

		if ($manifest = $this->faviconMetadata->getManifest()) {
			$wrapper->add('link', [
				'rel' => 'manifest',
				'href' => MetadataUtility::replaceUrlVariables($manifest, $this->request)
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
