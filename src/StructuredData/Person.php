<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData;

final class Person implements StructuredData
{

	/** @var mixed[] */
	private array $data;

	public function __construct(string $name, ?string $url = null)
	{
		$this->data = array_filter([
			'@type' => 'Person',
			'name' => $name,
			'url' => $url,
		]);
	}

	/**
	 * @return mixed[]
	 */
	public function toJson(): array
	{
		return array_filter(
			$this->data,
			fn (mixed $value): bool => $value !== null,
		);
	}

}
