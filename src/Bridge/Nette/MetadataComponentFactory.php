<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette;

interface MetadataComponentFactory
{

	public function create(): MetadataComponent;

}
