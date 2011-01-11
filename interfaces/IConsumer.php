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
		
		/* check nonce exist */
		public function hasNonce($nonce);
		
		/* Add a nonce to the nonce cache */
		public function addNonce($nonce);
		
		public function getId();
		
		
	}

?>
