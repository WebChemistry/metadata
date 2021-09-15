<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette\Event;

use Nette\Application\Application;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use WebChemistry\Metadata\Event\MetadataStartupEvent;
use WebChemistry\Metadata\Metadata\OgMetadata;

final class StartupEventSubscriber implements EventSubscriberInterface
{

	public function __construct(
		private OgMetadata $ogMetadata,
		private Application $application,
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
		if (!$this->ogMetadata->getLink()) {
			$this->ogMetadata->setLink($this->application->getPresenter()?->link('//this'));
		}
	}

}
