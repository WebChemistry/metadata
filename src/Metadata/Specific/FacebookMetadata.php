<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific;

final class FacebookMetadata
{

	public function __construct(
		private ?string $verification = null,
		private ?string $pixel = null,
	)
	{
	}

	public function getVerification(): ?string
	{
		return $this->verification;
	}

	public function getPixel(): ?string
	{
		return $this->pixel;
	}

	public function setPixel(?string $pixel): self
	{
		$this->pixel = $pixel;

		return $this;
	}

}
