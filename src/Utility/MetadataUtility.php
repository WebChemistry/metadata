<?php declare(strict_types = 1);

namespace WebChemistry\Metadata\Utility;

use InvalidArgumentException;
use Nette\Http\IRequest;
use Nette\Utils\Strings;

final class MetadataUtility
{

	public static function trim(?string $str): ?string
	{
		return $str !== null ? trim($str) : null;
	}

	public static function normalize(?string $str): ?string
	{
		return $str === null ? null : self::trim(strtr(strip_tags(html_entity_decode($str)), ["\xc2\xa0" => '']));
	}

	public static function truncate(?string $str, int $maxLen): ?string
	{
		if ($str === null) {
			return null;
		}

		return Strings::truncate(self::normalize($str), $maxLen);
	}

	public static function escapeJs(mixed $s): string
	{
		$json = json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		if ($error = json_last_error()) {
			throw new InvalidArgumentException(json_last_error_msg(), $error);
		}

		return str_replace([']]>', '<!', '</'], [']]\u003E', '\u003C!', '<\/'], $json);
	}

	public static function replaceUrlVariables(string $str, IRequest $request): string
	{
		$url = $request->getUrl();

		return strtr($str, [
			'$baseUrl' => rtrim($url->getBaseUrl(), '/'),
			'$basePath' => rtrim($url->getBasePath(), '/'),
		]);
	}

}
