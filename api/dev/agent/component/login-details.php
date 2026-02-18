<?php
	$response['companies'] = array(); // Initialize the data array

	$select = "SELECT a.*, b.status_name, c.role_name
	FROM company_contacts_tab a, setup_status_tab b, setup_role_tab c
	WHERE a.email='$email' AND a.status_id=b.status_id AND a.role_id=c.role_id AND a.status_id=1 AND (a.isApproved IS NULL OR a.isApproved != 'NO')";
	$query = mysqli_query($conn, $select) or die(mysqli_error($conn));

	while ($fetch_query = mysqli_fetch_assoc($query)) {
		///get company_id
		$company_id = $fetch_query['company_id'];

		$getCompanyQuery = mysqli_query($conn, "SELECT a.*, b.status_name
		FROM company_tab a, setup_status_tab b
		WHERE a.company_id ='$company_id' AND a.status_id=b.status_id") or die(mysqli_error($conn));
		$getCompanyDetails = mysqli_fetch_assoc($getCompanyQuery);

		$getContactsQuery = mysqli_query($conn, "SELECT a.*, b.status_name, c.role_name
		FROM company_contacts_tab a, setup_status_tab b, setup_role_tab c
		WHERE a.company_id='$company_id' AND a.status_id=b.status_id AND a.role_id=c.role_id") or die(mysqli_error($conn));
		$contactPersonsDetails = array();

		while ($getContactDetail = mysqli_fetch_assoc($getContactsQuery)) {
			$contactPersonsDetails[] = $getContactDetail;
		}
		$getCompanyDetails['contact_persons'] = $contactPersonsDetails;

		$fetch_query['company_details'] = $getCompanyDetails;
		$fetch_query['company_details']['documentStoragePath'] = "$documentStoragePath/company-logo";
		$response['companies'][] = $fetch_query;
	}
?>