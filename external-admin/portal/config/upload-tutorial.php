<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
$action=$_POST['action'];

switch ($action){
	case 'uploadTutorialFiles':
		$oldtutorialPicture = $_POST['oldtutorialPicture'] ?? '';
		$newtutorialPicture = $_POST['newtutorialPicture'] ?? '';
		$tutorialPicture = $_POST['tutorialPicture'] ?? '';

	
		///// Validate Exam Logo /////
		if (!empty($tutorialPicture)) {
    		$tutorialPicture = preg_replace('#^data:image/\w+;base64,#i', '', $tutorialPicture);
			$tutorialPicture = str_replace(' ', '+', $tutorialPicture);
			$tutorialPicture = base64_decode($tutorialPicture);
		}
		
		//// Upload Exam Logo ////
		$uploadTutorialPicturesDir = "../../uploaded_files/tutorialPictures/";

		//// Create Directory If Not Exists ////
		if(!empty($newtutorialPicture)){
			unlink($uploadTutorialPicturesDir . $oldtutorialPicture);
			file_put_contents($uploadTutorialPicturesDir . $newtutorialPicture, $tutorialPicture);
		}	


		////// Tutorial Video //////
		$oldtutorialVideo = $_POST['oldtutorialVideo'] ?? '';
		$tutorialVideoDir = "../../uploaded_files/tutorialVideos/";

		// Check if a new file is uploaded
		if (isset($_FILES['tutorialVideo']) && $_FILES['tutorialVideo']['error'] === UPLOAD_ERR_OK) {
			$newtutorialVideo = $_POST['newtutorialVideo'] ?? $_FILES['tutorialVideo']['name']; // fallback to uploaded filename

			// Delete old material if it exists
			if (!empty($oldtutorialVideo) && file_exists($tutorialVideoDir . $oldtutorialVideo)) {
				unlink($tutorialVideoDir . $oldtutorialVideo);
			}

			// Move uploaded file
			move_uploaded_file($_FILES['tutorialVideo']['tmp_name'], $tutorialVideoDir . $newtutorialVideo);
		}


		////// Tutorial Material //////
		$oldtutorialMaterial = $_POST['oldtutorialMaterial'] ?? '';
		$tutorialMaterialDir = "../../uploaded_files/tutorialMaterials/";

		// Check if a new file is uploaded
		if (isset($_FILES['tutorialMaterial']) && $_FILES['tutorialMaterial']['error'] === UPLOAD_ERR_OK) {
			$newtutorialMaterial = $_POST['newtutorialMaterial'] ?? $_FILES['tutorialMaterial']['name']; // fallback to uploaded filename

			// Delete old material if it exists
			if (!empty($oldtutorialMaterial) && file_exists($tutorialMaterialDir . $oldtutorialMaterial)) {
				unlink($tutorialMaterialDir . $oldtutorialMaterial);
			}

			// Move uploaded file
			move_uploaded_file($_FILES['tutorialMaterial']['tmp_name'], $tutorialMaterialDir . $newtutorialMaterial);
		}
    break;
}
?>