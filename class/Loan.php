<?php 

/**
*Class loan 
*
*/
abstract class Loan 
{
	protected $loanStartDate;
	protected $loanEndDate;
	protected $interestRate;
	protected $maximumInvestmentAllowed;
	protected $time;
	protected $interestEarned;
	protected $investedAmount;

	/**
	*Function  to calulate interest for the invested amount
	*
	*/
	public abstract function calculateInterest(float $investmentAmount,$investmentStartDate);
	
}
?>