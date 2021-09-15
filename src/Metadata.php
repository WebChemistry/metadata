<?php declare(strict_types = 1);

namespace WebChemistry\Metadata;

use Nette\Utils\Html;
use Psr\EventDispatcher\EventDispatcherInterface;
use WebChemistry\Metadata\Event\MetadataStartupEvent;
use WebChemistry\Metadata\Html\Wrapper;

final class Metadata
{

	private bool $calledStartup = false;

	/**
	 * @param MetadataExtensionInterface[] $extensions
	 */
	public function __construct(
		private array $extensions,
		private ?EventDispatcherInterface $dispatcher = null,
	)
	{
	}

	public function getHead(): Html
	{
		$this->startup();

		$wrapper = new Wrapper();

		foreach ($this->extensions as $extension) {
			$extension->head($wrapper);
		}

		return $wrapper->toHtml();
	}

	public function getBody(): Html
	{
		$this->startup();

		$wrapper = new Wrapper();

		foreach ($this->extensions as $extension) {
			$extension->body($wrapper);
		}

		return $wrapper->toHtml();
	}

	public function getFooter(): Html
	{
		$this->startup();

		$wrapper = new Wrapper();

		foreach ($this->extensions as $extension) {
			$extension->footer($wrapper);
		}

		return $wrapper->toHtml();
	}

	public function wrap(Html ...$els): Html
	{
		$el = Html::el();

		foreach ($els as $item) {
			$el->insert(null, $item);
		}

		return $el;
	}

	private function startup(): void
	{
		if ($this->calledStartup) {
			return;
		}

		$this->calledStartup = true;

		$this->dispatcher?->dispatch(new MetadataStartupEvent());
	}

}
