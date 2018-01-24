<?php
#wallet functions
require_once('jsonrpc.php');


class ODNPool {
	public $odn;
	
	public function __construct() {
		$user = 'user';
		$password = 'password';
		$this->odn = new Obsidiand($user,$password);
	}
	
	public function getConnections() {
		$connections = $this->odn->getinfo()["connections"];
		if($this->odn->error) {
			$connections = false;
		}
		return $connections;
	}
	
	public function getTotal() {
		$total = $this->odn->getinfo()["balance"];
		if($this->odn->error) {
			$total = false;
		}
		return $total;
	}
	
	public function getStaking() {
		$amount = $this->odn->getstakinginfo()["staking"];
		if($this->odn->error) {
			$amount = false;
		}
		return $amount;
	}
	
	public function getStakingWeight() {
		$weight = round(($this->odn->getstakinginfo()["weight"])/100000000, 1);
		if($this->odn->error) {
			$weight = false;
		}
		return $weight;
	}
	
	public function getLastTransactions() {
		$transactions = $this->odn->listtransactions('*',50);
		return $transactions;
	}
}
?>