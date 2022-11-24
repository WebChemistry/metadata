<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\StructuredData;

interface StructuredData
{

	/**
	 * @return mixed[]
	 */
	public function toJson(): array;

}
