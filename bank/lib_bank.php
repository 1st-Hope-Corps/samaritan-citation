<?php
# Filename:	lib_bank.php
# Dependencies: lib_connect.php, lib_json.php
# Description: Class that directly interacts with the Bank's database

class Bank{
	protected $_oConn;
	protected $_oJSON;
	protected $_aQuery;
	protected $_sModule;
	
	protected $_aAcceptedModule = array(
										"truecafelist", "userlist", "register", "retrieve", "community", 
										"pay", "loanlist", "delete", "create", "send", "buy", "balance", "multiple_balance", 
										"history", "loan", "loandebit", "truecafe"
									);
	
	public $sAccountNumber;
	public $sAccountPass;
	public $iSenderId;
	public $iRecipientId;
	
	
	function __construct($oConn, $oDrupalConn, $oJSON, $sQuery){
		$this->_oConn = $oConn;
		$this->_oDrupalConn = $oDrupalConn;
		$this->_oJSON = $oJSON;
		$this->_aQuery = $this->_oJSON->decode($sQuery);
		
		self::_ValidateQuery();
	}
	
	protected function _ValidateQuery(){
		if (isset($this->_aQuery["key"]) && isset($this->_aQuery["pass"]) && 
				trim($this->_aQuery["key"]) != "" && trim($this->_aQuery["pass"]) != ""){
			
			if (!self::_isValidUser($this->_aQuery["key"], $this->_aQuery["pass"])) self::_DisplayError(0);
		}else{
			self::_DisplayError(1);
		}
		
		if (isset($this->_aQuery["module"]) && trim($this->_aQuery["module"]) != ""){
			$this->_sModule = $this->_aQuery["module"];
			if (!self::_isValidModule()) self::_DisplayError(2);
		}else{
			self::_DisplayError(3);
		}
		
		if (!in_array($this->_aQuery["module"], array($this->_aAcceptedModule[0], $this->_aAcceptedModule[1], $this->_aAcceptedModule[2], $this->_aAcceptedModule[3], $this->_aAcceptedModule[4]))){
			if (!isset($this->_aQuery["vars"]) || !is_array($this->_aQuery["vars"]) || 
					count($this->_aQuery["vars"]) < 2){
				
				if ($this->_aQuery["module"] != "loandebit") self::_DisplayError(4);
			}else{
				if (isset($this->_aQuery["vars"]["key"]) && isset($this->_aQuery["vars"]["pass"]) && 
						trim($this->_aQuery["vars"]["key"]) != "" && trim($this->_aQuery["vars"]["pass"]) != ""){
					
					if (!self::_isValidDepositor($this->_aQuery["vars"]["key"], $this->_aQuery["vars"]["pass"])){
						self::_DisplayError(5);
					}
				}else{
					self::_DisplayError(6);
				}
			}
		}
	}
	
	protected function _isValidUser($sKey, $sPass){
		$sqlVerify = "SELECT COUNT(iDevId) 
						FROM dev_user 
						WHERE sDevAPI = '".$sKey."' 
							AND sDevPass = '".$sPass."'";
		
		return ($this->_oConn->Scalar($sqlVerify) == 1) ? TRUE:FALSE;
	}
	
	protected function _isValidModule(){
		return in_array($this->_sModule, $this->_aAcceptedModule);
	}
	
	protected function _isValidDepositor($sKey, $sPass){
		$sqlVerify = "SELECT iUserId, sUserFName 
						FROM bank_user 
						WHERE sUserAccount = '".$sKey."' 
							AND sUserPass = '".$sPass."' 
							AND bActive = '1'";
		
		$aResultSet = $this->_oConn->Query($sqlVerify);
		
		if ($this->_oConn->NumRows() == 1){
			$this->iSenderId = $aResultSet[0]["iUserId"];
			$this->iSenderName = $aResultSet[0]["sUserFName"];
			
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	protected function _isValidAccount($sAccountNumber){
		$sqlVerify = "SELECT iUserId, sUserFName 
						FROM bank_user 
						WHERE sUserAccount = '".$sAccountNumber."'";
		
		$aResultSet = $this->_oConn->Query($sqlVerify);
		
		if ($this->_oConn->NumRows() == 1){
			$this->iRecipientId = $aResultSet[0]["iUserId"];
			$this->iRecipientName = $aResultSet[0]["sUserFName"];
			
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	protected function _isExistingDepositor($sEmail){
		$sqlVerify = "SELECT sUserAccount, sUserPass 
						FROM bank_user 
						WHERE sUserEmail = '".$sEmail."'";
		
		$aResultSet = $this->_oConn->Query($sqlVerify);
		
		if ($this->_oConn->NumRows() == 1){
			$this->sAccountNumber = $aResultSet[0]["sUserAccount"];
			$this->sAccountPass = $aResultSet[0]["sUserPass"];
			
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function _GenerateString($sCharPool, $iLength){
		$sOutput = "";
		
		for ($i = 0; $i < $iLength; $i++) {
			$sShuffledPool = str_shuffle($sCharPool);
			$sOutput .= substr($sShuffledPool, 0, 1);
		}
		
		return $sOutput;
	}
	
	protected function _GenerateAccount($iLength=4){
		$sCharPool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		
		return self::_GenerateString($sCharPool, $iLength)."-".mktime();
	}
	
	protected function _GeneratePass($iLength=10){
		$sCharPool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		
		return sha1(self::_GenerateString($sCharPool, $iLength));
	}
	
	protected function Escape($sString, $bNoHTML=true){
		$sOutput = (get_magic_quotes_gpc()) ? stripslashes($sString):$sString;
		$sOutput = addslashes(trim($sOutput));
		
		if ($bNoHTML) $sOutput = strip_tags($sOutput);
		
		return $sOutput;
	}
	
	protected function YearDiff($dDateFrom, $dDateTo=null){
		if (is_null($dDateTo)) $dDateTo = date("Y-m-d");
		
		$iDateFrom = strtotime($dDateFrom, 0);
		$iDateTo = strtotime($dDateTo, 0);
		$iSecsDiff = $iDateTo - $iDateFrom;
		$iYearsDiff = floor($iSecsDiff / 31536000);
		
		// $aDateFrom = date_parse($dDateFrom);
		// $aDateTo = date_parse($dDateTo);
		
		// $iTimestamp1 = mktime(0, 0, 0, $aDateFrom["month"], $aDateFrom["day"], $aDateFrom["year"]+$iYearsDiff);
		// $iTimestamp2 = mktime(0, 0, 0, $aDateTo["month"], $aDateTo["day"], $aDateTo["year"]-($iYearsDiff+1));
		
		// if ($iTimestamp1 > $iDateTo) $iYearsDiff--;
		// if ($iTimestamp2 > $iDateFrom) $iYearsDiff++;
		
		return $iYearsDiff;
	}
	
	public function Execute(){
		date_default_timezone_set('Asia/Manila');
		
		switch ($this->_sModule){
			case "userlist":
				$sqlUserList = "SELECT A.iUserId, B.mBalance, A.sUserAccount, 
									A.sUserFName, A.sUserLName, A.dUserDOB, 
									A.sUserEmail, A.dDateCreated 
								FROM bank_user A 
								INNER JOIN bank_user_balance B ON A.iUserId = B.iUserId
								WHERE A.bActive = '1' 
								ORDER BY A.iUserId";//A.dDateCreated >= DATE_ADD(CURRENT_DATE(), INTERVAL -7 DAY) 
				
				$aResultSet = $this->_oConn->Query($sqlUserList);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => $aResultSet
								);
				
				break;
			
			case "truecafelist":
				$sqlUserList = "SELECT A.iUserId, B.mBalance, A.sUserAccount, 
									A.sUserFName, A.sUserLName, A.dUserDOB, 
									A.sUserEmail, A.dDateCreated 
								FROM bank_user A 
								INNER JOIN bank_user_balance B ON A.iUserId = B.iUserId
								WHERE A.bActive = '1' 
								ORDER BY A.iUserId";//A.dDateCreated >= DATE_ADD(CURRENT_DATE(), INTERVAL -7 DAY) 
				
				$aResultSet = $this->_oConn->Query($sqlUserList);
				
				for ($x=0; $x<$this->_oConn->NumRows(); $x++){
					$sqlUser = "SELECT A.uid, A.name, A.mail
								FROM users A 
								INNER JOIN bank_users B ON B.uid = A.uid 
								WHERE A.status = 1 
									AND B.account_number = '".$aResultSet[$x]["sUserAccount"]."'";
					
					$aUser = $this->_oDrupalConn->Query($sqlUser);
					
					if ($this->_oDrupalConn->NumRows() == 0){
						unset($aResultSet[$x]);
					}else{
						$sUserName = $aUser[0]["name"];
						$iDrupalId = $aUser[0]["uid"];
						
						$sqlTrueCafe = "SELECT value FROM profile_values WHERE fid = 52 AND uid = ".$iDrupalId;
						$bTrueCafe = $this->_oDrupalConn->Scalar($sqlTrueCafe);
						
						if (!$bTrueCafe || (int)$bTrueCafe == 0){
							unset($aResultSet[$x]);
						}else{
							$aResultSet[$x][] = $sUserName;
							$aResultSet[$x]["sUserName"] = $sUserName;
						}
					}
				}
				
				if (count($aResultSet) == 0){
					self::_DisplayError(200, $this->_oConn->ErrMsg());
				}else{
					$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => array_values($aResultSet)
								);
				}
				
				break;
				
			case "register":
				$sUserEmail = self::Escape($this->_aQuery["vars"]["email"]);
				
				if (!self::_isExistingDepositor($sUserEmail)){
					$this->sAccountNumber = self::_GenerateAccount();
					$this->sAccountPass = self::_GeneratePass();
					
					$sqlRegister = "INSERT INTO bank_user 
									VALUES(
										NULL, 
										'".$this->sAccountNumber."', 
										'".$this->sAccountPass."', 
										'".self::Escape($this->_aQuery["vars"]["fname"])."', 
										'".self::Escape($this->_aQuery["vars"]["mname"])."', 
										'".self::Escape($this->_aQuery["vars"]["lname"])."', 
										'".self::Escape($this->_aQuery["vars"]["dob"])."', 
										'".$sUserEmail."',
										'1',
										'".date("Y-m-d H:i:s")."'
									)";
					
					if (!$this->_oConn->Execute($sqlRegister)){
						self::_DisplayError(3306, $this->_oConn->ErrMsg());
					}else{
						$sqlIniBal = "INSERT INTO bank_user_balance 
										VALUES(".$this->_oConn->LastID().", 0, 0, 0)";
						
						$this->_oConn->Execute($sqlIniBal);
					}
				}else{
					$sqlUpdate = "UPDATE bank_user 
									SET bActive = '1' 
									WHERE sUserEmail = '".$sUserEmail."'";
					
					$this->_oConn->Execute($sqlUpdate);
				}
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => array(
													"ACCT" => $this->sAccountNumber, 
													"PASS" => $this->sAccountPass
												)
								);
				
				break;
			
			case "delete":
				$sqlDelete = "UPDATE bank_user 
								SET bActive = '0' 
								WHERE sUserAccount = '".$this->_aQuery["vars"]["key"]."'";
				$sqlBal = "UPDATE bank_user_balance 
							SET mBalance = '0.00',
								mPending = '0.00',
								mTurnover = '0.00'
							WHERE iSenderId = ".$this->iSenderId;
				$sqlTrans = "DELETE FROM bank_user_transact WHERE iSenderId = ".$this->iSenderId;
				
				$this->_oConn->Execute($sqlDelete);
				$this->_oConn->Execute($sqlBal);
				$this->_oConn->Execute($sqlTrans);
				
				break;
				
			case "loan":
			case "create":
			case "send":
			case "truecafe":
				if (self::_isValidAccount($this->_aQuery["vars"]["recipient"])){
					$iTransactTime = microtime(true);
					$sReference = str_replace(".", "-", $iTransactTime);
					
					$sCommmunityTime = (isset($this->_aQuery["vars"]["time"]) && $this->_aQuery["vars"]["time"] != "") ? "'".$this->_aQuery["vars"]["time"]."'":"NULL";
					$mTransactAmount = $this->_aQuery["vars"]["amount"];
					$mSenderAmount = $mTransactAmount;
					$mReceiverAmount = $mTransactAmount;
					$mRealMoney = 0;
					
					$sSubDescriptor1 = "";
					$sSubDescriptor2 = "";
					$sRetrieved = "NULL";
					
					switch ($this->_sModule){
						case "send":
							$sDescriptor = "Sent awards to";
							$mSenderAmount = number_format($mSenderAmount * -1, 2);
							
							break;
							
						case "create":
							$sDescriptor = "Created awards for";
							
							break;
						
						case "truecafe":
							$sDescriptor = "Sent awards to";
							$mSenderAmount = number_format($mSenderAmount * -1, 2);
							$mRealMoney = $this->_aQuery["vars"]["realmoney"];
							
							$sSubDescriptor1 = " for his/her TrueCafe account (Real Money = ".$mRealMoney.")";
							$sSubDescriptor2 = " for your TrueCafe account (Real Money = ".$mRealMoney.")";
							$sRetrieved = "'0'";
							
							break;
							
						case "loan":
							$sDescriptor = "Loaned awards to";
							$sSubDescriptor2 = " as a Loan";
							
							break;
					}
					
					$sTransactDesc1 = $sDescriptor." user ".$this->iRecipientName.$sSubDescriptor1.".";
					$sTransactDesc1 .= ($this->_sModule == "create" || $this->_sModule == "loan") ? "\n".self::Escape($this->_aQuery["vars"]["description"]):"";
					
					$sTransactDesc2 = "Received awards from user ".$this->iSenderName.$sSubDescriptor2.".";
					$sTransactDesc2 .= ($this->_sModule == "create" || $this->_sModule == "loan") ? "\n".self::Escape($this->_aQuery["vars"]["description"]):"";
					
					$sqlSend = "INSERT INTO bank_user_transact 
								VALUES
								(
									NULL,
									'".$this->_sModule."',
									".$this->iSenderId.",
									".$this->iRecipientId.",
									'".$mSenderAmount."',
									'".$mRealMoney."',
									".$sCommmunityTime.",
									'".date("Y-m-d H:i:s", $iTransactTime)."',
									'".$sReference."',
									'".$sTransactDesc1."',
									'0',
									NULL,
									NULL
								),
								(
									NULL,
									'receive',
									".$this->iRecipientId.",
									".$this->iSenderId.",
									'".$mReceiverAmount."',
									'".$mRealMoney."',
									".$sCommmunityTime.",
									'".date("Y-m-d H:i:s", $iTransactTime)."',
									'".$sReference."',
									'".$sTransactDesc2."',
									'0',
									NULL,
									".$sRetrieved."
								)";
					
					if (!$this->_oConn->Execute($sqlSend)){
						self::_DisplayError(3306, $this->_oConn->ErrMsg());
					}else{
						if ($this->_sModule == "truecafe"){
							$mDebitAmount = number_format($mReceiverAmount * -1, 2);
							$sqlDebit = "INSERT INTO bank_user_transact 
										VALUES(
											NULL, 
											'debit', 
											".$this->iRecipientId.", 
											".$this->iSenderId.",
											'".$mDebitAmount."',
											'".$mRealMoney."', 
											'".date("Y-m-d H:i:s", $iTransactTime)."',
											'".$sReference."',
											'Transferred awards to your TrueCafe account (Real Money = ".$mRealMoney.").', 
											'0',
											NULL, 
											NULL
										)";
							$sqlTurnover = "UPDATE bank_user_balance 
											SET mTurnover = mTurnover + ".$mTransactAmount." 
											WHERE iUserId = ".$this->iRecipientId;
							
							$this->_oConn->Execute($sqlDebit);
							$this->_oConn->Execute($sqlTurnover);
						}
						
						$sqlBalMinus = "UPDATE bank_user_balance 
										SET mBalance = mBalance - ".$mTransactAmount."
										WHERE iUserId = ".$this->iSenderId;
						
						$sqlBalPlus = "UPDATE bank_user_balance 
										SET mBalance = mBalance + ".$mTransactAmount.", 
											mTurnover = mTurnover + ".$mTransactAmount." 
										WHERE iUserId = ".$this->iRecipientId;
						
						if ($this->_sModule != "create" && $this->_sModule != "loan") $this->_oConn->Execute($sqlBalMinus);
						if ($this->_sModule != "truecafe") $this->_oConn->Execute($sqlBalPlus);
						
						$aStatusMsg = array(
										"STATUS" => "Success", 
										"RETURN" => array(
														"REF" => $sReference, 
														"TIME" => date("Y-m-d H:i:s", $iTransactTime)
													)
									);
					}
				}else{
					self::_DisplayError(7);
				}
				
				break;
				
			case "balance":
				$sqlBalances = "SELECT mBalance, mPending, mTurnover 
								FROM bank_user_balance 
								WHERE iUserId = ".$this->iSenderId;
				$aResultSet = $this->_oConn->Query($sqlBalances);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => array(
													"BALANCE" => number_format($aResultSet[0]["mBalance"], 2), 
													"PENDING" => number_format($aResultSet[0]["mPending"], 2), 
													"TURNOVER" => number_format($aResultSet[0]["mTurnover"], 2)
												)
								);
				
				break;
				
			case "multiple_balance":

				foreach($this->_aQuery['vars']['samaritanAccountNumbers'] as &$samaritanAccountNumbers){
				   $samaritanAccountNumbers = "'$samaritanAccountNumbers'";
				}

				$sqlBalances = "SELECT sum(mBalance) as mBalance FROM bank_user_balance LEFT JOIN bank_user on bank_user_balance.iUserId = bank_user.iUserId WHERE bank_user.sUserAccount IN ($samaritanAccountNumbers)";


				$aResultSet = $this->_oConn->Query($sqlBalances);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => array(
										"BALANCE" => number_format($aResultSet[0]["mBalance"], 2)
									)
								);
				break;
			
			case "history":
				$sqlHistory = "SELECT B.sUserFName AS sRecipient, A.sTransactType, 
									A.iSenderId, A.iRecipientId, A.mTransactAmount, 
									A.mRealMoney, A.dTransactTime, A.sReference, 
									A.sTransactDesc, A.bTransactConfirm, A.dConfirmTime 
								FROM bank_user_transact A 
								INNER JOIN bank_user B ON B.iUserId = A.iRecipientId 
								WHERE A.iSenderId = ".$this->iSenderId." 
									AND A.bTransactConfirm = '0' 
								ORDER BY A.dTransactTime DESC";
				$aResultSet = $this->_oConn->Query($sqlHistory);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => $aResultSet
								);
				
				break;
			
			case "retrieve":
				$sqlRetrieve = "SELECT iTransactId, iSenderId AS iRecipientId, 
									mRealMoney, sReference, dTransactTime 
								FROM bank_user_transact 
								WHERE bRetrieved = '0'";
				$aResultSet = $this->_oConn->Query($sqlRetrieve);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => $aResultSet
								);
				
				foreach ($aResultSet as $aThisRecord){
					$sqlUpdate = "UPDATE bank_user_transact 
									SET bRetrieved = '1' 
									WHERE iTransactId = ".$aThisRecord["iTransactId"];
					$this->_oConn->Execute($sqlUpdate);
				}
				
				break;
			
			case "loanlist":
				$sqlBorrower = "SELECT A.iUserId, A.sUserFName, B.iTransactId, B.dTransactTime, 
									B.sTransactDesc, IF(C.sTransactType IS NULL, FALSE, TRUE) AS bPaid, 
									B.sReference, B.mTransactAmount, D.mBalance 
								FROM bank_user A 
								INNER JOIN bank_user_transact B ON B.iRecipientId = A.iUserId AND B.sTransactType = 'loan' 
								LEFT JOIN bank_user_transact C ON C.sReference = B.sReference AND C.sTransactType = 'debit' 
								INNER JOIN bank_user_balance D ON D.iUserId = A.iUserId 
								WHERE C.sTransactType IS NULL 
								ORDER BY B.dTransactTime DESC";
				$aResultSet = $this->_oConn->Query($sqlBorrower);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => $aResultSet
								);
				
				break;
			
			case "loandebit":
				$bError = false;
				$aTransactId = $this->_aQuery["vars"]["transactid"];
				$iRecordCount = count($aTransactId);
				$mPaidLoan = 0;
				
				for ($x=0; $x<$iRecordCount; $x++){
					$sqlTransact = "SELECT iRecipientId, sTransactType, sReference, mTransactAmount 
									FROM bank_user_transact 
									WHERE iTransactId = ".$aTransactId[$x];
					$aResultSet = $this->_oConn->Query($sqlTransact);
					
					$iRecipient = $aResultSet[0]["iRecipientId"];
					$sReference = $aResultSet[0]["sReference"];
					$mTransactAmount = $aResultSet[0]["mTransactAmount"];
					$mLoanedAmount = $mTransactAmount * -1;
					
					$sqlDebit = "INSERT INTO bank_user_transact 
								VALUES(
									NULL, 
									'debit', 
									".$iRecipient.", 
									0, 
									'".$mLoanedAmount."', 
									'0', 
									'".date("Y-m-d H:i:s")."', 
									'".$sReference."', 
									'Payment for Loan.', 
									'0', 
									NULL, 
									NULL
								)";
					
					if (!$this->_oConn->Execute($sqlDebit)){
						$bError = true;
						break;
					}else{
						$mPaidLoan += $mTransactAmount;
						
						$sqlBalMinus = "UPDATE bank_user_balance 
										SET mBalance = mBalance - ".$mTransactAmount."
										WHERE iUserId = ".$iRecipient;
						$this->_oConn->Execute($sqlBalMinus);
					}
				}
				
				if ($bError){
					self::_DisplayError(3306, $this->_oConn->ErrMsg());
				}else{
					$aStatusMsg = array(
										"STATUS" => "Success", 
										"RETURN" => "Loan payment successful. ".$iRecordCount." user(s) have paid their debt. A total of ".number_format($mPaidLoan, 2)." have been paid."
									);
				}
				
				break;
			
			case "pay":
				if (self::_isValidAccount($this->_aQuery["vars"]["recipient"])){
					$iTransactTime = microtime(true);
					$sReference = str_replace(".", "-", $iTransactTime);
					$mTransactAmount = $this->_aQuery["vars"]["amount"];
					$sDescription = $this->_aQuery["vars"]["description"];
					$mSenderAmount = number_format($mTransactAmount * -1, 2);
					$mReceiverAmount = $mTransactAmount;
					
					$sqlPay = "INSERT INTO bank_user_transact 
									VALUES(
										NULL, 
										'".$this->_sModule."', 
										".$this->iSenderId.", 
										".$this->iRecipientId.",
										'".$mSenderAmount."',
										NULL,
										NULL,
										'".date("Y-m-d H:i:s", $iTransactTime)."',
										'".$sReference."',
										'".$sDescription."', 
										'0',
										NULL, 
										NULL
									),
									(
										NULL, 
										'receive', 
										".$this->iRecipientId.",
										".$this->iSenderId.", 
										'".$mReceiverAmount."',
										NULL,
										NULL,
										'".date("Y-m-d H:i:s", $iTransactTime)."',
										'".$sReference."',
										'".$sDescription." by user ".$this->iSenderName."', 
										'0',
										NULL, 
										NULL
									)";
					
					if (!$this->_oConn->Execute($sqlPay)){
						self::_DisplayError(3306, $this->_oConn->ErrMsg()." ".$sqlPay);
					}else{
						$sqlBalMinus = "UPDATE bank_user_balance 
										SET mBalance = mBalance - ".$mTransactAmount."
										WHERE iUserId = ".$this->iSenderId;
						
						$sqlBalPlus = "UPDATE bank_user_balance 
										SET mBalance = mBalance + ".$mTransactAmount.", 
											mTurnover = mTurnover + ".$mTransactAmount." 
										WHERE iUserId = ".$this->iRecipientId;
						
						$this->_oConn->Execute($sqlBalMinus);
						$this->_oConn->Execute($sqlBalPlus);
						
						$aStatusMsg = array(
											"STATUS" => "Success", 
											"RETURN" => array(
															"REF" => $sReference, 
															"TIME" => date("Y-m-d H:i:s", $iTransactTime)
														)
										);
					}
				}else{
					self::_DisplayError(7);
				}
				
				break;
			
			case "community":
				$sqlCommunity = "SELECT A.sCommmunityTime, A.dTransactTime
								FROM bank_user_transact A
								INNER JOIN bank_user B ON B.iUserId = A.iSenderId
								WHERE B.sUserAccount = '".$this->_aQuery["vars"]["key"]."'
									AND sCommmunityTime IS NOT NULL";
				
				$aResultSet = $this->_oConn->Query($sqlCommunity);
				
				$aStatusMsg = array(
									"STATUS" => "Success", 
									"RETURN" => $aResultSet
								);
				
				break;
		}
		
		echo $this->_oJSON->encode($aStatusMsg);
	}
	
	protected function _DisplayError($iErrorType, $sExtraMsg=""){
		$aStatusMsg = array("STATUS" => "Error");
		
		switch ($iErrorType){
			case 0:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Invalid key and pass.";
				break;
			case 1:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Missing key/pass value.";
				break;
			case 2:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Invalid module.";
				break;
			case 3:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Missing module value.";
				break;
			case 4:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Invalid or Missing vars value.";
				break;
			case 5:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Invalid account details of sender.";
				break;
			case 6:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Missing key/pass value for sender.";
				break;
			case 7:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Invalid account number for recipient.";
				break;
			case 3306:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "Internal Error (".$this->_sModule.").";
				$aStatusMsg["ERR_EXTRA"] = $sExtraMsg;
				break;
			case 200:
				$aStatusMsg["ERR_TYPE"] = $iErrorType;
				$aStatusMsg["ERR_MSG"] = "No data can be returned.";
				break;
			default:
				$aStatusMsg["ERR_TYPE"] = "Unknown";
				$aStatusMsg["ERR_MSG"] = "";
				$aStatusMsg["ERR_EXTRA"] = $sExtraMsg;
				break;
		}
		
		$sThisErrorJSON = $this->_oJSON->encode($aStatusMsg);
		self::_LogError($sThisErrorJSON);
		
		exit($sThisErrorJSON);
	}
	
	protected function _LogError($sErrorJSON){
		$sqlError = "INSERT INTO error_log 
						VALUES(
							NULL, 
							'".date("Y-m-d H:i:s")."', 
							'".$this->_sModule."',
							'".self::Escape($sErrorJSON)."',
							'".self::Escape($this->_oJSON->encode($this->_aQuery))."'
						)";
		
		$this->_oConn->Execute($sqlError);
	}
	
	function __destruct(){
		$this->_oConn->DBClose();
		$this->_oDrupalConn->DBClose();
		
		/* // Display object properties
		echo '<h2>Properties of object being destroyed</h2>';
		
		foreach (get_object_vars($this) as $sProperty => $sValues){
			echo '<p>'.$sProperty.'='.$sValues.'</p>';
		}
		
		// Display object methods
		echo '<h2>Methods of object being destroyed</h2>';
		
		$aMethods = get_class_methods(get_class($this));
		
		foreach($methods as $method) {
			echo '<p> Method Name: '.$method.'()</p>';
		} */
	}
}
?>