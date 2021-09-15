<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Html;

use LogicException;
use Nette\Utils\FileSystem;
use Nette\Utils\Html;

final class Wrapper
{

	private Html $el;

	public function __construct()
	{
		$this->el = Html::el();
	}

	public function addHtmlFromTemplate(string $file, array $variables): self
	{
		$this->addHtml(
			Html::el()->addHtml(
				$this->renderToString($file, $variables)
			)
		);

		return $this;
	}

	public function addMetaWithName(string $name, ?string $content): self
	{
		if (!$content) {
			return $this;
		}

		$this->add('meta', [
			'name' => $name,
			'content' => $content,
		]);

		return $this;
	}

	public function addMetaWithProperty(string $property, ?string $content): self
	{
		if (!$content) {
			return $this;
		}

		$this->add('meta', [
			'property' => $property,
			'content' => $content,
		]);

		return $this;
	}

	public function add(string $name, array $attributes = [], ?string $html = null, ?string $text = null): self
	{
		$el = Html::el($name, $attributes);

		if ($html) {
			$el->setHtml($html);
		}

		if ($text) {
			$el->setText($text);
		}

		$this->addHtml($el);

		return $this;
	}

	public function addHtml(Html $el): self
	{
		$this->el->insert(null, $el);

		return $this;
	}

	public function toHtml(): Html
	{
		return $this->el;
	}

	private function renderToString(string $file, array $variables): string
	{
		$contents = FileSystem::read($file);

		return preg_replace_callback('#\{\{\s*(\w+)\s*}}#', function (array $matches) use ($variables): string {
			if (!isset($variables[$matches[1]])) {
				throw new LogicException(sprintf('Template variable %s not exists.', $matches[1]));
			}

			return htmlspecialchars($variables[$matches[1]], ENT_QUOTES);
		}, $contents);
	}

}
