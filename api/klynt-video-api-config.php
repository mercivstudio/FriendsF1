<?php
/**
 * v 1.0.3
 * Copyright 2015, Honkytonk Films
 * http://www.klynt.net
 * */

/* Cache configuration */
/* If cache is enabled, The cache directory defined below should be created manually. */
/* Don't use long cache durations because the cached information (such as urls) may expire. */
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 600); // In seconds
define('CACHE_EXTENSION', '.cache');
define('CACHE_DIRECTORY', './cache/');

/* Vimeo configuration */
define('VIMEO_CLIENT_ID', 'c4973cff35ecbae90f137ef9f549dc9701ea3b54');
define('VIMEO_CLIENT_SECRET', 'eqlWLMtTSWGeta25VdYNS6yzo0HuPYGNadUSzCYzXNmPCXh3Kjdzs1W3p4qOidanvazGZ/UPualeEJHgc2jEtI/gM8L28cI1uzasahjg8cX6z095ePN2x2o7FXAY94Fj');
define('VIMEO_CLIENT_ACCESS_TOKEN', '26055278fde00a0646c7b2e180d664bc');

/* Brightcove configuration */
define('BCMAPI_READ_API_TOKEN', '');

/* Ooyala configuration */
define('OOYALA_API_KEY', '');
define('OOYALA_API_SECRET', '');
?>
