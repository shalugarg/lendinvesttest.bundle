<?php
abstract class AbstractInvestor 
{
	
	protected $investorName;
	protected $walletMoney;
	protected $investmentAmount;
	protected $investmentloanStartDate;
	protected $interestEarned;

	function __construct($investorName,$walletMoney){
		$this->investorName=$investorName;
		$this->walletMoney=0;
		$this->walletMoney=$walletMoney;
	}
	abstract function invest(float $investmentAmount,$investmentStartDate,$trancheName,$trancheArray);


}

?>
