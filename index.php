<?php 
error_reporting(0);
require_once("wallet_func.php");
$odnPool = new ODNPool();
$json = file_get_contents("https://api.coinmarketcap.com/v1/ticker/obsidian/");
$obj = json_decode($json, true);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ODNDash</title>
	    <link rel="stylesheet" href="css/normalize.css">
	    <link rel="stylesheet" href="css/skeleton.css">
	    <link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<div class="section content">
			<div class="container">
				<div class="row" style="text-align: center;">
					<h1>Your Obsidian Wallet</h1>
				</div>
			</div>
			<div class="container" >
				<div class="row">
					<div class="four columns offset-by-two columns">Wallet status:</div>
					<div class="four columns" style="text-align: right;"><?php $conn = $odnPool->getConnections(); if($conn !== false) { echo $conn . " Connections"; } else { echo "Down";}?></div>
				</div>
				<div class="row">
					<div class="four columns offset-by-two columns">Total ODN:</div>
					<div class="four columns" style="text-align: right;"><?php $total = $odnPool->getTotal(); if($total !== false) { echo number_format($total, 2, '.', ',') . " ODN";} ?></div>
				</div>
				<div class="row">
					<div class="four columns offset-by-two columns">USD Value:</div>
					<div class="four columns" style="text-align: right;"><?php if($total !== false AND $obj[0]["price_usd"] > 0.00) { echo "$ " . number_format($total*$obj[0]["price_usd"], 2, '.', ',');} ?></div>
				</div>
				<div class="row">
					<div class="four columns offset-by-two columns">Staking active:</div>
					<div class="four columns" style="text-align: right;"><?php $staking = $odnPool->getStaking(); if($staking !== false) { echo "Active"; } else { echo "Not staking"; } ?></div>
				</div>
				<div class="row">
					<div class="four columns offset-by-two columns">Staking weight:</div>
					<div class="four columns" style="text-align: right;"><?php $weight = $odnPool->getStakingWeight(); if($weight !== false) { echo number_format($weight, 2, '.', ',') . " ODN"; }?></div>
				</div>
				<div class="row">
					<div class="four columns offset-by-two columns">Network weight:</div>
					<div class="four columns" style="text-align: right;"><?php $weight = $odnPool->getNetworkWeight(); if($weight !== false) { echo number_format($weight, 2, '.', ',') . " ODN"; }?></div>
				</div>
			</div>
			<div class="container" style="text-align: center;">
				<h5>Last 50 transactions</h5>
				<?php $transactions = $odnPool->getLastTransactions();?>
				<table class="u-full-width">
					<thead>
						<tr>
							<th>Date Time</th>
							<th>Type</th>
							<th>Amount</th>
							<th>Confs</th>
							<th>Address</th>
							<th>Tx</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i = sizeof($transactions) -1; $i > 0; $i--) {
							if(is_array($transactions[$i])) {
								$type = $transactions[$i]["category"];
								?>
								<tr>
									<td style="text-align: right;"><?php echo date('Y-m-d H:i:s',$transactions[$i]["blocktime"] ); ?></td>
									<td style="text-align: right;"><?php echo $type; ?></td>
									<td style="text-align: right;"><?php echo number_format($transactions[$i]["amount"], 8, '.', ',') . " ODN";?></td>
									<td style="text-align: right;"><?php echo $transactions[$i]["confirmations"];?></td>
									<td style="text-align: right;"><?php echo $transactions[$i]["address"]; ?></td>
									<td style="text-align: right;"><a href="http://obsidianblockchain2.westeurope.cloudapp.azure.com/transaction/<?php echo $transactions[$i]["txid"]; ?>" target='_blank' alt ='<?php echo $transactions[$i]["txid"]; ?>'>Tx</a></td>
								</tr>
							<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>