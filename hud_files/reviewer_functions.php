<?php

function getReviewerDashboardData($user)
{
	$iUserId = $user->uid;
	$iAvailableHopefuls =_kindness_mentor_hopeful_available();
	$iAvailableHopefuls = empty($iAvailableHopefuls) ? 0 : $iAvailableHopefuls;
	$iRequest = _kindness_mentor_request_count($iUserId);
	$iRequest = empty($iRequest) ? 0 : $iRequest;
	$iHopePoints = userpoints_get_current_points($iUserId, "all");
	$iAssignedHopeful = _kindness_mentor_hopeful_count($iUserId) * 1;
	$aAssignedHopeful = _kindness_mentor_hopeful_count($iUserId, "list");
	$iPendingWorkz = _kindness_mentor_kindness($iUserId);
	$iWaitingHopefuls = _kindness_mentor_kindness($iUserId, "hopeful");

	$aHopefuls = _kindness_mentor_hopeful($iUserId);
	$approveWorkzCount	= "SELECT COUNT(DISTINCT A.id) as total_approved
					FROM kindness_submit A
					INNER JOIN users B ON B.uid = A.iUserId
					INNER JOIN kindness_comment C ON C.iSubmitId = A.id
					WHERE A.bApprovedMentor = '1'
						AND A.iUserId IN (%s)
						AND C.iUserId = %d
						AND C.bApproved = '1'";
	$approveWorkzCount = db_query(sprintf($approveWorkzCount, implode(",", $aHopefuls), $iUserId));
	$iApprovedWorkz = db_fetch_object($approveWorkzCount)->total_approved;

	$disApproveWorkzCount = "SELECT COUNT(A.id) as total_disapproved
				FROM kindness_submit A
				INNER JOIN users B ON B.uid = A.iUserId
				INNER JOIN kindness_comment C ON C.iSubmitId = A.id
				WHERE A.bApprovedMentor = '0'
					AND A.iUserId IN (%s)
					AND C.iUserId = %d
					AND C.bApproved = '0'";
	$disApproveWorkzCount = db_query(sprintf($disApproveWorkzCount, implode(",", $aHopefuls), $iUserId));
	$iDisApprovedWorkz = db_fetch_object($disApproveWorkzCount)->total_disapproved;

	return [
		'iAvailableHopefuls' => $iAvailableHopefuls,
		'iRequest' => $iRequest,
		'iHopePoints' => $iHopePoints,
		'iAssignedHopeful' => $iAssignedHopeful,
		'aAssignedHopeful' => $aAssignedHopeful,
		'iPendingWorkz' => $iPendingWorkz,
		'iWaitingHopefuls' => $iWaitingHopefuls,
		'iApprovedWorkz' => $iApprovedWorkz,
		'iDisApprovedWorkz' => $iDisApprovedWorkz,
	];
}
