<?php

	require_once(dirname(__FILE__)."/../interfaces/IConsumer.php");
	
	/* this class is just for the example purpose
	 * It's badly written but it's just for POC 
	 */
	class Consumer implements IConsumer{
		
		private $id;
		private $key;
		private $secret;
		private $active;
		private $pdo;
		
		public static function findByKey($key){
			$consumer = null;
			$pdo = Db::singleton();
			$info = $pdo->query("select id from consumer where consumer_key = '".$key."'"); // this is not safe !
			if($info->rowCount()==1){
				$info = $info->fetch();
				$consumer = new Consumer($info['id']);
			}
			return $consumer;
		}
		
		public static function findByRequestToken($token){
			$consumer = null;
			$pdo = Db::singleton();
			$info = $pdo->query("select consumer_id from request_token where token = '".$token."'"); // this is not safe !
			if($info->rowCount()==1){
				$info = $info->fetch();
				$consumer = new Consumer($info['consumer_id']);
			}
			return $consumer;
		}
		
		public function __construct($id = 0){
			$this->pdo = Db::singleton();
			if($id != 0){
				$this->id = $id;
				$this->load();
			}
		}
		
		private function load(){
			$info = $this->pdo->query("select * from consumer where id = '".$this->id."'")->fetch();
			$this->id = $this->id;
			$this->key = $info['consumer_key'];
			$this->secret = $info['consumer_secret'];
			$this->active = $info['active'];
		}
		
		public static function create($key,$secret){
			
		}
		
		public function isActive(){
			return $this->active;
		}
		
		public function getSecretKey(){
			return $this->secret;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function hasNonce($nonce){
			$check = $this->pdo->query("select count(*) as cnt from consumer_nonce where nonce = '".$nonce."' and consumer_id = ".$this->id)->fetch();
			if($check['cnt']==1){
				return true;
			} else {
				return false;
			}
		}
		
		public function addNonce($nonce){
			$check = $this->pdo->exec("insert into consumer_nonce (consumer_id,timestamp,nonce) values (".$this->id.",".time().",'".$nonce."')");
		}
		
		/* setters */
		
		public function setKey($key){
			$this->key = $key;
		}
		
		public function setSecret($secret){
			$this->secret = $secret;
		}
		
		public function setActive($active){
			$this->active = $active;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
	}
	
?>
