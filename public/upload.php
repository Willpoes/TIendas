<?php
if (isset($_POST['submit'])) {
	$j = 0;     // Variable for indexing uploaded image.
	$target_path = "uploads/";     // Declaring Path for uploaded images.
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	// Loop to get individual element from the array
	$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
	$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	$file_extension = end($ext); // Store extensions in the variable.
	$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
	$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
	if (($_FILES["file"]["size"][$i] < 100000)     // Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
	if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
	// If file moved to uploads folder.
	echo $j. ').<span id="noerror">Imagen cargada con éxito !.</span><br/><br/>';
	} else {     //  If File Was Not Moved.
	echo $j. ').<span id="error">¡Inténtalo de nuevo!.</span><br/><br/>';
	}
	} else {     //   If File Size And File Type Was Incorrect.
	echo $j. ').<span id="error">*** Tamaño o tipo de archivo no válido ***</span><br/><br/>';
	}
	}
}
?>