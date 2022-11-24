<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData\Part;

class PaywallPart
{

	/** @var mixed[] */
	private array $parts = [];

	public function addPart(string $cssSelector, bool $isForFree = false): self
	{
		$this->parts[] = [
			'@type' => 'WebPageElement',
			'isAccessibleForFree' => $isForFree ? 'True' : 'False',
			'cssSelector' => $cssSelector,
		];

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function toJson(): array
	{
		return [
			'isAccessibleForFree' => 'False',
			'hasPart' => count($this->parts) === 1 ? current($this->parts) : $this->parts,
		];
	}

}
