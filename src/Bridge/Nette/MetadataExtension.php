<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Bridge\Nette;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use WebChemistry\Metadata\Bridge\Nette\Event\StartupEventSubscriber;
use WebChemistry\Metadata\Extension\BasicExtension;
use WebChemistry\Metadata\Extension\ColorExtension;
use WebChemistry\Metadata\Extension\FacebookExtension;
use WebChemistry\Metadata\Extension\FaviconExtension;
use WebChemistry\Metadata\Extension\GoogleExtension;
use WebChemistry\Metadata\Extension\LanguageExtension;
use WebChemistry\Metadata\Extension\OgExtension;
use WebChemistry\Metadata\Extension\RssExtension;
use WebChemistry\Metadata\Extension\StructuredDataExtension;
use WebChemistry\Metadata\Metadata;
use WebChemistry\Metadata\Metadata\BasicMetadata;
use WebChemistry\Metadata\Metadata\ColorMetadata;
use WebChemistry\Metadata\Metadata\FaviconMetadata;
use WebChemistry\Metadata\Metadata\GoogleMetadata;
use WebChemistry\Metadata\Metadata\OgMetadata;
use WebChemistry\Metadata\Metadata\TwitterMetadata;
use WebChemistry\Metadata\MetadataExtensionInterface;

final class MetadataExtension extends CompilerExtension
{

	private const EXTENSIONS = [
		'basic' => BasicExtension::class,
		'favicon' => FaviconExtension::class,
		'og' => OgExtension::class,
		'color' => ColorExtension::class,
		'google' => GoogleExtension::class,
		'facebook' => FacebookExtension::class,
		'structuredData' => StructuredDataExtension::class,
		'language' => LanguageExtension::class,
		'rss' => RssExtension::class,
	];

	private const METADATA = [
		'basic' => BasicMetadata::class,
		'color' => ColorMetadata::class,
		'google' => GoogleMetadata::class,
		'og' => OgMetadata::class,
		'twitter' => TwitterMetadata::class,
		'facebook' => Metadata\FacebookMetadata::class,
		'language' => Metadata\LanguageMetadata::class,
		'rss' => Metadata\RssMetadata::class,
		'structuredData' => Metadata\StructuredDataMetadata::class,
	];

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'basic' => Expect::structure([
				'title' => Expect::string()->required(),
				'description' => Expect::string()->nullable(),
				'titleTemplate' => Expect::string()->nullable(),
				'author' => Expect::string()->nullable(),
			]),
			'color' => Expect::structure([
				'color' => Expect::string()->nullable(),
			]),
			'favicon' => Expect::structure([
				'icons' => Expect::listOf(Expect::structure([
					'link' => Expect::string()->required(),
					'type' => Expect::string()->nullable(),
					'sizes' => Expect::string()->nullable(),
					'rel' => Expect::string('icon'),
				])),
				'manifest' => Expect::string()->nullable(),
			]),
			'google' => Expect::structure([
				'verification' => Expect::string()->nullable(),
				'analytics' => Expect::string()->nullable(),
			]),
			'facebook' => Expect::structure([
				'verification' => Expect::string()->nullable(),
				'pixel' => Expect::string()->nullable(),
			]),
			'og' => Expect::structure([
				'image' => Expect::string()->nullable(),
			]),
			'twitter' => Expect::structure([
				'site' => Expect::string()->nullable(),
			]),
			'language' => Expect::structure([
				'lang' => Expect::string()->nullable(),
			]),
			'rss' => Expect::structure([
				'link' => Expect::string()->nullable(),
			]),
 		]);
	}

	public function loadConfiguration(): void
	{
		$config = (array) $this->getConfig();
		$builder = $this->getContainerBuilder();

		foreach (self::EXTENSIONS as $name => $class) {
			$builder->addDefinition($this->prefix('extension.' . $name))
				->setType(MetadataExtensionInterface::class)
				->setFactory($class);
		}

		foreach (self::METADATA as $name => $class) {
			$builder->addDefinition($this->prefix('metadata.' . $name))
				->setFactory($class, (array) ($config[$name] ?? []));
		}

		$favicon = $config['favicon'];
		$service = $builder->addDefinition($this->prefix('metadata.favicon'))
			->setFactory(FaviconMetadata::class, [$favicon->manifest]);

		foreach ($favicon->icons as $icon) {
			$service->addSetup('addIcon', (array) $icon);
		}

		$builder->addFactoryDefinition($this->prefix('factory'))
			->setImplement(MetadataComponentFactory::class);

		$builder->addDefinition($this->prefix('metadata'))
			->setFactory(Metadata::class);

		$builder->addDefinition($this->prefix('eventSubscriber'))
			->setFactory(StartupEventSubscriber::class);
	}

}
