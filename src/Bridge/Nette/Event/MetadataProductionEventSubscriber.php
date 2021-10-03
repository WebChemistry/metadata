<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use WebChemistry\Metadata\Event\MetadataStartupEvent;
use WebChemistry\Metadata\Metadata\FacebookMetadata;
use WebChemistry\Metadata\Metadata\GoogleMetadata;

final class MetadataProductionEventSubscriber implements EventSubscriberInterface
{

	public function __construct(
		private bool $production,
		private GoogleMetadata $googleMetadata,
		private FacebookMetadata $facebookMetadata,
	)
	{
	}

	public static function getSubscribedEvents(): array
	{
		return [
			MetadataStartupEvent::class => 'startup',
		];
	}

	public function startup(): void
	{
		if (!$this->production) {
			$this->googleMetadata->setAnalytics(null);
		}

		if (!$this->production) {
			$this->facebookMetadata->setPixel(null);
		}
	}

}
