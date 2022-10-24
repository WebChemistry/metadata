<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

use \WebChemistry\Metadata\Metadata\Specific as S;

class Metadata
{

	public function __construct(
		public readonly S\BasicMetadata $basic = new S\BasicMetadata(),
		public readonly S\GoogleMetadata $google = new S\GoogleMetadata(),
		public readonly S\FaviconMetadata $favicon = new S\FaviconMetadata(),
		public readonly S\FacebookMetadata $facebook = new S\FacebookMetadata(),
		public readonly S\TwitterMetadata $twitter = new S\TwitterMetadata(),
		public readonly S\OgMetadata $og = new S\OgMetadata(),
	)
	{
	}

}
