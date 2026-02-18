<?php include '../../../config/constants.php';?>
<script src="js/session_validation.js"></script>
<?php
$action=$_POST['action'];

switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		include '../content/page-content.php';
	break;

	case 'get_page_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/page-content.php';
	break;

	case 'get_class_page_with_id':
		$page=$_POST['page'];
		$department_id=$_POST['department_id'];
		$class_id=$_POST['class_id'];
		include '../content/page-content.php';
	break;

	case 'get_video_page_with_id':
		$page=$_POST['page'];
		$department_id=$_POST['department_id'];
		$class_id=$_POST['class_id'];
		$subject_id=$_POST['subject_id'];
		$term_id=$_POST['term_id'];
		include '../content/page-content.php';
	break;

	case 'get_form':
		$page=$_POST['page'];
		include '../content/form.php';
	break;

	case 'get_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/form.php';
	break;

	case 'get_subject_form_with_id':
		$page=$_POST['page'];
		$department_id=$_POST['department_id'];
		$class_id=$_POST['class_id'];
		include '../content/form.php';
	break;

	case 'get_video_form_with_id':
		$page=$_POST['page'];
		$department_id=$_POST['department_id'];
		$class_id=$_POST['class_id'];
		$subject_id=$_POST['subject_id'];
		$tutorial_id=$_POST['tutorial_id'];
		include '../content/form.php';
	break;


	case 'get_secondary_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$company_id=$_POST['company_id'];
		$staff_id=$_POST['staff_id'];
		include '../content/form.php';
	break;

	case 'get_detail':
		$ids=$_POST['ids'];
		$page=$_POST['page'];
		include '../content/form.php';
	break;
	
	case 'get_page_details':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$question_id=$_POST['question_id'];
		include '../content/form.php';
	break;
	
	case 'create_department_folder':
		$department_id = strtoupper(trim($_POST['department_id']));
		$department_name = trim($_POST['department_name']);
		$urls= trim(strtolower($_POST['urls']));
		$seo_keywords = trim($_POST['seo_keywords']);
		$seo_description = trim($_POST['seo_description']);
		$thumbnail = $_POST['thumbnail']; 
	
		$page_seo_pix = $thumbnail;
		///////////////////////create new exam folder//////////////////
		mkdir('../../../department/'.$urls);
		
		// Write to index.php file
		$myfile = fopen("../../../department/" . $urls . "/index.php", "w") or die("Unable to open file!");
		$txt = "<?php include '../../../config/constants.php';?>\n";
		$txt .= "<?php " . strval('$department_id') . "='$department_id';?>\n";
		$txt .= "<?php " . strval('$department_name') . "='$department_name';?>\n";
		$txt .= "<?php " . strval('$urls') . "='$urls';?>\n";
		$txt .= "<?php " . strval('$seo_keywords') . "='$seo_keywords';?>\n";
		$txt .= "<?php " . strval('$seo_description') . "='$seo_description';?>\n";
		$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
		$txt .= "<?php include '../department-content-details.php';?>";
		fwrite($myfile, $txt);
		fclose($myfile);
	break;
	

	case 'update_department_folder':
		$thumbnail = $_POST['thumbnail']; // Get the name of the uploaded file
		$db_thumbnail = $_POST['db_thumbnail'];
		$department_id = strtoupper(trim($_POST['department_id']));
		$department_name = trim($_POST['department_name']);
		$urls= trim(strtolower($_POST['urls']));
		$db_urls = $_POST['db_urls'];
		$seo_keywords = trim($_POST['seo_keywords']);
		$seo_description = trim($_POST['seo_description']);
	
		$page_seo_pix = $thumbnail;
		// Check if a file has been uploaded
		if (empty($page_seo_pix)||($page_seo_pix=='')||($page_seo_pix==null)) {
			$page_seo_pix = $db_thumbnail;
		} 

		// Rename folder
		rename("../../../department/$db_urls", "../../../department/$urls");

		$myfile = fopen("../../../department/" . $urls . "/index.php", "w") or die("Unable to open file!");
		$txt = "<?php include '../../../config/constants.php';?>\n";
		$txt .= "<?php " . strval('$department_id') . "='$department_id';?>\n";
		$txt .= "<?php " . strval('$department_name') . "='$department_name';?>\n";
		$txt .= "<?php " . strval('$urls') . "='$urls';?>\n";
		$txt .= "<?php " . strval('$seo_keywords') . "='$seo_keywords';?>\n";
		$txt .= "<?php " . strval('$seo_description') . "='$seo_description';?>\n";
		$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
		$txt .= "<?php include '../department-content-details.php';?>";
		fwrite($myfile, $txt);
		fclose($myfile);
	break;
	

	case 'create_department_class_folder':
		$response = json_decode($_POST['response'], true);
		$department_id = $response['department_id'];
		$department_url = $response['department_url'];

		foreach ($response['data'] as $class) {
			// Access class properties: $class['class_id'], $class['class_name'], etc.
			$classId = $class['class_id'];
			$class_name = $class['class_name'];
			$thumbnail = $class['thumbnail'];
			$page_title = $class['page_title'];
			$seo_keywords = $class['seo_keywords'];
			$seo_description = $class['seo_description'];
			$urls= $class['urls'];


			mkdir('../../../department/'.$department_url.'/'.$urls);

			// Write to index.php file
			$myfile = fopen("../../../department/".$department_url.'/'.$urls."/index.php", "w") or die("Unable to open file!");
			$txt = "<?php include '../../../config/constants.php';?>\n";
			$txt .= "<?php \$department_id='$department_id';?>\n";
			$txt .= "<?php \$class_id='$classId';?>\n";
			$txt .= "<?php \$department_url='$department_url';?>\n";
			$txt .= "<?php \$class_name='$class_name';?>\n";
			$txt .= "<?php \$thumbnail='$thumbnail';?>\n";
			$txt .= "<?php \$urls='$urls';?>\n";
			$txt .= "<?php \$page_title='$page_title';?>\n";
			$txt .= "<?php \$seo_keywords='$seo_keywords';?>\n";
			$txt .= "<?php \$seo_description='$seo_description';?>\n";
			$txt .= "<?php include '../../class-content-details.php';?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}	
	break;


	case 'create_subject_class_folder':
		$response = json_decode($_POST['response'], true);

		$department_id = $response['department_id'];
		$department_url = $response['department_url'];
		$class_id = $response['class_id'];
		$class_url = $response['class_url'];

		foreach ($response['data'] as $subject) {
			// Access class properties: $class['class_id'], $class['class_name'], etc.
			$subject_id = $subject['subject_id'];
			$subject_name = $subject['subject_name'];
			$thumbnail = $subject['thumbnail'];
			$page_title = $subject['page_title'];
			$seo_keywords = $subject['seo_keywords'];
			$seo_description = $subject['seo_description'];
			$urls= $subject['urls'];


			mkdir('../../../department/'.$department_url.'/'.$class_url.'/'.$urls);

			// Write to index.php file
			$myfile = fopen("../../../department/".$department_url.'/'.$class_url.'/'.$urls."/index.php", "w") or die("Unable to open file!");
			$txt = "<?php include '../../../config/constants.php';?>\n";
			$txt .= "<?php \$department_id='$department_id';?>\n";
			$txt .= "<?php \$class_id='$class_id';?>\n";
			$txt .= "<?php \$department_url='$department_url';?>\n";
			$txt .= "<?php \$class_url='$class_url';?>\n";
			$txt .= "<?php \$subject_id='$subject_id';?>\n";
			$txt .= "<?php \$subject_name='$subject_name';?>\n";
			$txt .= "<?php \$thumbnail='$thumbnail';?>\n";
			$txt .= "<?php \$urls='$urls';?>\n";
			$txt .= "<?php \$page_title='$page_title';?>\n";
			$txt .= "<?php \$seo_keywords='$seo_keywords';?>\n";
			$txt .= "<?php \$seo_description='$seo_description';?>\n";
			$txt .= "<?php include '../../../subject-content-details.php';?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	break;

	case 'create_tutorial_folder':
		$tutorial_id = strtoupper(trim($_POST['tutorial_id']));
		$urls= trim(strtolower($_POST['urls']));
		$department_urls= trim(strtolower($_POST['department_urls']));
		$class_urls= trim(strtolower($_POST['class_urls']));
		$subject_urls= trim(strtolower($_POST['subject_urls']));
		$thumbnail = $_POST['thumbnail']; 

		$page_seo_pix = $thumbnail;
		///////////////////////create new exam folder//////////////////
		mkdir('../../../department/'.$department_urls.'/'.$class_urls.'/'.$subject_urls.'/'.$urls);
		
		// Write to index.php file
		$myfile = fopen("../../../department/".$department_urls.'/'.$class_urls.'/'.$subject_urls.'/'.$urls."/index.php", "w") or die("Unable to open file!");
		$txt = "<?php include '../../../../config/constants.php';?>\n";
		$txt .= "<?php " . strval('$tutorial_id') . "='$tutorial_id';?>\n";
		$txt .= "<?php " . strval('$urls') . "='$urls';?>\n";
		$txt .= "<?php " . strval('$department_urls') . "='$department_urls';?>\n";
		$txt .= "<?php " . strval('$class_urls') . "='$class_urls';?>\n";
		$txt .= "<?php " . strval('$subject_urls') . "='$subject_urls';?>\n";
		$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
		$txt .= "<?php include '../../../../topic-content-details.php';?>";
		fwrite($myfile, $txt);
		fclose($myfile);
	break;

	case 'update_tutorial_video_folder':
		$tutorial_id = strtoupper(trim($_POST['tutorial_id']));
		$urls= trim(strtolower($_POST['urls']));
		$db_urls= trim(strtolower($_POST['db_urls']));
		$department_urls= trim(strtolower($_POST['department_urls']));
		$class_urls= trim(strtolower($_POST['class_urls']));
		$subject_urls= trim(strtolower($_POST['subject_urls']));
		$thumbnail = $_POST['thumbnail']; // Get the name of the uploaded file
		$db_thumbnail = $_POST['db_thumbnail'];

	
		$page_seo_pix = $thumbnail;
		// Check if a file has been uploaded
		if (empty($page_seo_pix)||($page_seo_pix=='')||($page_seo_pix==null)) {
			$page_seo_pix = $db_thumbnail;
		} 

		// Rename folder
		rename("../../../department/$department_urls/$class_urls/$subject_urls/$db_urls", "../../../department/$department_urls/$class_urls/$subject_urls/$urls");

		$myfile = fopen("../../../department/".$department_urls.'/'.$class_urls.'/'.$subject_urls.'/'.$urls."/index.php", "w") or die("Unable to open file!");
		$txt = "<?php include '../../../../config/constants.php';?>\n";
		$txt .= "<?php " . strval('$tutorial_id') . "='$tutorial_id';?>\n";
		$txt .= "<?php " . strval('$urls') . "='$urls';?>\n";
		$txt .= "<?php " . strval('$department_urls') . "='$department_urls';?>\n";
		$txt .= "<?php " . strval('$class_urls') . "='$class_urls';?>\n";
		$txt .= "<?php " . strval('$subject_urls') . "='$subject_urls';?>\n";
		$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
		$txt .= "<?php include '../../../../topic-content-details.php';?>";
		fwrite($myfile, $txt);
		fclose($myfile);
	break;

}
?>