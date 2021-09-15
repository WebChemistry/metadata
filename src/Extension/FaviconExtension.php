<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use Nette\Http\Request;
use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\FaviconMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class FaviconExtension implements MetadataExtensionInterface
{

	public function __construct(
		private FaviconMetadata $faviconMetadata,
		private Request $request,
	)
	{
	}

	public function head(Wrapper $wrapper): void
	{
		if (!($icon = $this->faviconMetadata->getIcon())) {
			return;
		}

		$icon = MetadataUtility::replaceUrlVariables($icon, $this->request);

		$wrapper->add('link', [
			'rel' => 'icon',
			'href' => $icon,
			'type' => $this->faviconMetadata->getType(),
		]);
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

}
