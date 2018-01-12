<?php

namespace Drupalpay;

interface Config
{
	const CONTENT_TYEP = "Content-Type: application/json";

	const ACCEPT_TYPE = "Accept: application/json";

	const BASE_URL = "https://apidev.fattlabs.com/";

/* ------------------------------- */

	const EMAIL = "";

	const PASSWORD = "";

	const APP_KEY = "";

/* ------------------------------- */

	const AUTHENTICATE_ROUTE = 'authenticate';

	const GETBILLINFORMATION_ROUTE = 'bill';
}

?>