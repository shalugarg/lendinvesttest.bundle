<?php 

include('AbstractInvestor.php');

class Investor extends AbstractInvestor
{
	public function getWalletMoney()
	{
		return $this->walletMoney;
	}

	public function invest(float $investmentAmount,$investmentStartDate,$trancheName,$trancheArray)
	{
		$trancheobj=null;
		$trancheobj=$this->findtrancheObj($trancheName,$trancheArray);

		$earningDetailArray=Array();
		$earningDetailArray['investorName']=$this->investorName;
		$earningDetailArray['investmentAmount']=$investmentAmount;
		$earningDetailArray['investmentStartDate']=date('Y-m-d',strtotime($investmentStartDate));
		if(is_null($trancheobj)){
				$earningDetailArray['interestEarned']='invalid Tranch';
		}else{
			//if investtor has enough balance in the wallet
			if( $investmentAmount <= $this->getWalletMoney()){

				//Maximum investment allowed is not reached
				if($investmentAmount <= (($trancheobj->getmaximumInvestmentAllowed()) -($trancheobj->getInvestedAmount())) )
				{
					$this->interestEarned=$trancheobj->calculateInterest($investmentAmount,$investmentStartDate);
					$trancheobj->setInvestedAmount($investmentAmount);
					$earningDetailArray['interestEarned']=$this->interestEarned;
				}else{
					$earningDetailArray['interestEarned']='Sorry,Maximum Investment Allowed exceeds';
				}
			}else{
					$earningDetailArray['interestEarned']='Sorry,You donot have enough money in your wallet';
			}
			
				
		}
			return $earningDetailArray;
	}
	public function findtrancheObj($trancheName,$trancheArray)
	{
		$trancheobj = null;
		foreach($trancheArray as $element) {
		    if ($trancheName == $element->trancheName) {
		        $trancheobj = $element;
		        break;
		    }
		}
		return $trancheobj;
	}
}
?>