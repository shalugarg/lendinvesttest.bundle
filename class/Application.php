<?php class Application {
	
	public function createLoan() {
		$loanStr=file_get_contents('loan.json');
		$loanJson=json_decode($loanStr);
		$trancheArray=array();
		foreach($loanJson->tranches as $tranches){
			$trancheobj=null;
			$trancheobj=new Tranches($tranches->name);
			$trancheobj->initializetranche($tranches->loanStartDate,$tranches->loanEndDate,$tranches->interestRate,$tranches->maximumInvestmentAllowed);
			$trancheArray[]=$trancheobj;
		}
		return $trancheArray;
	}

	public function createInvestors( $trancheArray ) {
		$investorStr=file_get_contents('Investor.json');
		$investorJson=json_decode($investorStr);
		$investorArray=array();
		foreach($investorJson->investor as $investor){
			$investorobj=null;
			$investorobj=new Investor($investor->name,$investor->walletMoney);

			$investorArray[]=$investorobj->invest($investor->investmentAmount,$investor->investmentStartDate,$investor->trancheName,$trancheArray);

		}
		$investorResult=json_encode($investorArray);
		return $investorResult;
	}
}

?>