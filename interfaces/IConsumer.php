<?php

	interface IConsumer{
		
		/* return an instance of a IConsumer or return null on not found */
		public static function findByKey($key);
		
		/* return an instance of a IConsumer or return null on not found */
		public static function findByRequestToken($token);
		
		/* Create in the DB a consumer with a given key & secret */
		public static function create($key,$secret);
		
		/* Returns if the consumer is active */
		public function isActive();
		
		/* Returns the consumer secret key */
		public function getSecretKey();
		
		/* add a request token in the db */
		public function addRequestToken($token,$token_secret,$callback_url);
		
		/* generate access token */
		public function setVerifier($request_token,$verifier);
		
	}

?>
