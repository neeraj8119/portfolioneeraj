<?php
if(isset($_FILES['resume']) && $_FILES['resume']['error'] === 0){
    $file_name = $_FILES['resume']['name'];
    $file_tmp = $_FILES['resume']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = ['pdf','doc','docx'];
    $upload_dir = "uploads/";

    if(!in_array($file_ext,$allowed)){
        echo "<p>❌ Invalid file type.</p>"; exit;
    }

    if(!file_exists($upload_dir)){ mkdir($upload_dir,0777,true); }

    $new_name = time().'_'.preg_replace('/\s+/','_',$file_name);
    $file_path = $upload_dir.$new_name;

    if(move_uploaded_file($file_tmp,$file_path)){
        echo "<h2>✅ Resume Uploaded Successfully!</h2>";
        if($file_ext === 'pdf'){
            echo "<iframe src='$file_path' width='80%' height='600px' style='border:none;'></iframe>";
        }else{
            echo "<p><a href='$file_path' target='_blank'>View Resume</a></p>";
        }
    }else{ echo "<p>❌ Failed to upload.</p>"; }
}else{ echo "<p>No file uploaded.</p>"; }
?>
