<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata;

final class GoogleMetadata
{

	public function __construct(
		private ?string $analytics = null,
		private ?string $verification = null,
	)
	{
	}

	public function setAnalytics(?string $analytics): self
	{
		$this->analytics = $analytics;

		return $this;
	}

	public function getAnalytics(): ?string
	{
		return $this->analytics;
	}

	public function getVerification(): ?string
	{
		return $this->verification;
	}

}
