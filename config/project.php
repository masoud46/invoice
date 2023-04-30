<?php

$limits = env('APP_LOAD_INVOICE_LIMITS', [3, 6]);
if (!is_array($limits)) {
	try {
		$limits = json_decode($limits, true);
	} catch (\Throwable $th) {
		$limits = [3, 6];
	}
}
sort($limits);

return [
	'external_domains' => [
		'invoice.psychosexo.clinic',
		'serge.com',
		'manager.eva.com',
	],

	'default_country_code' => env('APP_DEFAULT_COUNTRY_CODE', 'LU'),
	'default_timezone' => env('APP_DEFAULT_TIMEZONE', 'Europe/Luxembourg'),
	'load_invoice_limits' => $limits,

];
