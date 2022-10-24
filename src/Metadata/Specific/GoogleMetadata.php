<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Metadata\Specific;

final class GoogleMetadata
{

	public function __construct(
		private ?string $analytics = null,
		private ?string $verification = null,
	)
	{
	}

	public function setVerification(?string $verification): void
	{
		$this->verification = $verification;
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
