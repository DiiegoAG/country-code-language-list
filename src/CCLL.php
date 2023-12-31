<?php
namespace Diegoarreola\CountryCodeLanguageList;
use Exception;
include 'countriesData.php';

define('countriesData', $countriesData);

class CCLL
{

	/* Return an array of coincidences finded filtering by name */
	public function searchByName ($country_name = null) {
		if (is_null($country_name)) {
			throw new Exception('Enter a country name to search');
		}

		$country_name = ucwords(strtolower($country_name));

		$data = [];

		foreach (countriesData as $country) {
			if ($country['name'] === $country_name) {
				array_push($data, $country);
			}
		}

		return $data;
	}

	/* Return an array with countries filtered by language */
	public function searchByLanguage ($country_language = null) {
		if (is_null($country_language)) {
			throw new Exception('Enter a language to search');
		}

		$country_language = ucwords(strtolower($country_language));

		$data = [];

		foreach (countriesData as $country) {
			if ($country['language'] === $country_language) {
				array_push($data, $country);
			}
		}

		return $data;
	}

	/* Return first coincidence filtered by three language code */
	public function searchBy2LC ($country_2lc = null) {
		if (is_null($country_2lc) || strlen($country_2lc) != 5 && $country_2lc !== 'en') {
			throw new Exception('Enter valid 2-letter language code');
		}

		if ($country_2lc === 'en') {
			$country_2lc = 'en-US';
		}

		$country_2lc = explode('-', str_replace('_', '-', $country_2lc));
		$country_2lc = strtolower($country_2lc[0]).'-'.strtoupper($country_2lc[1] ?? '');

		foreach (countriesData as $country) {
			if ($country['two_letter_code'] === $country_2lc) {
				return $country;
			}
		}

		return 'No match found';
	}

	/* Return first coincidence filtered by three language code */
	public function searchBy3LC ($country_3lc = null) {
		if (is_null($country_3lc) || strlen($country_3lc) != 6 && $country_2lc !== 'en') {
			throw new Exception('Enter valid 3-letter language code');
		}

		if ($country_2lc === 'en') {
			$country_2lc = 'en-US';
		}

		$country_3lc = explode('-', str_replace('_', '-', $country_3lc));
		$country_3lc = strtolower($country_3lc[0]).'-'.strtoupper($country_3lc[1] ?? '');

		foreach (countriesData as $country) {
			if ($country['three_letter_code'] === $country_3lc) {
				return $country;
			}
		}

		return 'No match found';
	}

}
