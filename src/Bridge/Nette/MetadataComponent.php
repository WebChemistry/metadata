<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette;

use Nette\Application\UI\Control;
use Nette\Utils\Html;
use WebChemistry\Metadata\Metadata;

final class MetadataComponent extends Control
{

	public function __construct(
		private Metadata $metadata,
	)
	{
	}

	public function render(): void
	{
		$this->renderEl(
			$this->metadata->wrap($this->metadata->getHead(), $this->metadata->getBody(), $this->metadata->getFooter())
		);
	}

	public function renderHead(): void
	{
		$this->renderEl($this->metadata->getHead());
	}

	public function renderBody(): void
	{
		$this->renderEl($this->metadata->getHead());
	}

	public function renderFooter(): void
	{
		$this->renderEl($this->metadata->getFooter());
	}

	/**
	 * @param array<string, string> $defaults
	 * @return array<string, string>
	 */
	public function getHtmlAttributes(array $defaults = []): array
	{
		return $this->metadata->getHtmlAttributes($defaults);
	}

	private function renderEl(Html $el): void
	{
		echo $el->render(0);
	}

}
