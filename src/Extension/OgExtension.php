<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Extension;

use Contributte\Imagist\Entity\PersistentImageInterface;
use Contributte\Imagist\LinkGeneratorInterface;
use InvalidArgumentException;
use LogicException;
use Nette\Http\IRequest;
use WebChemistry\Metadata\Html\Wrapper;
use WebChemistry\Metadata\Metadata\BasicMetadata;
use WebChemistry\Metadata\Metadata\OgMetadata;
use WebChemistry\Metadata\Metadata\TwitterMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;
use WebChemistry\Metadata\Utility\MetadataUtility;

final class OgExtension implements MetadataExtensionInterface
{

	public function __construct(
		private OgMetadata $ogMetadata,
		private BasicMetadata $basicMetadata,
		private TwitterMetadata $twitterMetadata,
		private IRequest $request,
		private ?LinkGeneratorInterface $imageLinkGenerator = null,
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
		$image = $this->getImage();

		$wrapper->addMetaWithProperty('og:title', $this->basicMetadata->getTitle());

		if ($image) {
			$wrapper->addMetaWithName('image', $image);
			$wrapper->addMetaWithProperty('og:image', $image);
			$wrapper->addMetaWithProperty('og:image:url', $image);
			$wrapper->addMetaWithProperty('og:image:secure_url', $image);
		}

		$wrapper->addMetaWithProperty('og:description', $this->basicMetadata->getDescription());
		$wrapper->addMetaWithProperty('og:url', $this->ogMetadata->getLink());

		$wrapper->addMetaWithName('twitter:card', 'summary_large_image');
		$wrapper->addMetaWithName('twitter:title', $this->basicMetadata->getTitle());
		$wrapper->addMetaWithName('twitter:description', $this->basicMetadata->getDescription());
		$wrapper->addMetaWithName('twitter:image', $image);
		$wrapper->addMetaWithName('twitter:site', $this->twitterMetadata->getSite());
	}

	public function body(Wrapper $wrapper): void
	{
	}

	public function footer(Wrapper $wrapper): void
	{
	}

	private function getImage(): ?string
	{
		foreach ($this->ogMetadata->getImages() as $image) {
			if (!$image) {
				continue;
			}

			if (is_string($image)) {
				return MetadataUtility::replaceUrlVariables($image, $this->request);
			}

			if ($image instanceof PersistentImageInterface) {
				if ($image->isEmpty()) {
					continue;
				}

				if (!$this->imageLinkGenerator) {
					throw new LogicException('Image link generator not found.');
				}

				return $this->imageLinkGenerator->link($image);
			}

			throw new InvalidArgumentException(sprintf('Image %s not supported.', get_debug_type($image)));
		}

		return null;
	}

}
