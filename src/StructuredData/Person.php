<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData;

final class Person implements StructuredData
{

	/** @var mixed[] */
	private array $data;

	public function __construct(string $name)
	{
		$this->data = [
			'@type' => 'Person',
			'name' => $name,
		];
	}

	/**
	 * @return mixed[]
	 */
	public function toJson(): array
	{
		return $this->data;
	}

}
