<?php 

include('Loan.php');

/**
*Class Traches 
*/
class Tranches  extends Loan
{
	public $trancheName;


	function __construct ($trancheName){
		$this->trancheName=$trancheName;
		$this->interestRate=0.0;
	}

	public function setloanStartDate($loanStartDate) {
		$this->loanStartDate=$loanStartDate;
	}
	public function setloanEndDate($loanEndDate) {
		$this->loanEndDate=$loanEndDate;
	}
	public function setInterestRate(float $interestRate) {
		$this->interestRate=$interestRate;
	}
	public function setmaximumInvestmentAllowed($maximumInvestmentAllowed) {
		$this->maximumInvestmentAllowed=$maximumInvestmentAllowed;
	}

	public function getmaximumInvestmentAllowed() {
		return $this->maximumInvestmentAllowed;
	}
	public function setInvestedAmount($investedAmount) {
		return $this->investedAmount += $investedAmount;
	}
	public function getInvestedAmount() {
		return $this->investedAmount;
	}

	/**
	*Function to initialize all the variables of a tranche after been created
	*/
	public function initializetranche($loanStartDate,$loanEndDate,$interestRate,$maximumInvestmentAllowed) {
			$this->setloanStartDate($loanStartDate);
			$this->setloanEndDate($loanEndDate);
			$this->setInterestRate($interestRate);
			$this->setmaximumInvestmentAllowed($maximumInvestmentAllowed);
			$this->investedAmount=0;
	}

	/**
	*Function to calcuate interest
	*/
	public function calculateInterest(float $investmentAmount,$investmentStartDate): float{

		$timeforInterest=$this->calculateTimeOfInvestment($investmentStartDate);
		//if investment no of days is not 0 or the loan end date has not reached
		if($timeforInterest != 0){
			$this->interestEarned=round(($investmentAmount*$this->interestRate*$timeforInterest)/100,2);
			return $this->interestEarned;
		}else{
			return 'Invalid time of Investment';
		}
	}

	public function calculateTimeOfInvestment($investmentStartDate) :float{
		//if investment starts date is greater or equal to loan start date and less than loan end date
		if( date('Y-m-d',strtotime($investmentStartDate)) >= date('Y-m-d',strtotime($this->loanStartDate)) &&
			(date('Y-m-d',strtotime($investmentStartDate)) < date('Y-m-d',strtotime($this->loanEndDate))) ){
			$timeforInterest=0;
			$loanFirstMonth=date_format(date_create($this->loanStartDate),'n');
			$loanFirstMonthEndDate=date('Y/m/t',strtotime($this->loanStartDate));
			//if loan end date is less than the last day of the month
			if(date('Y-m-d',strtotime($this->loanEndDate)) < date('Y-m-d',strtotime($loanFirstMonthEndDate))){
				$loanFirstMonthEndDate=$this->loanEndDate;
			}
			$DaysOfInvestment=date_diff(date_create($investmentStartDate),date_create($loanFirstMonthEndDate));
			$DaysOfInvestment=(float)($DaysOfInvestment->days+1);
			$totaldaysinFirstMonth=date_diff(date_create($this->loanStartDate),date_create($loanFirstMonthEndDate));
			$totaldaysinFirstMonth=(float)($totaldaysinFirstMonth->days+1);
			return $DaysOfInvestment/$totaldaysinFirstMonth;
		}else{
			return 0;
		}
		
	}


	
}

?>