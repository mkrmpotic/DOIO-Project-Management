<?php



/**

 * Simple Image Crop

 * http://marinkrmpotic.com

 *

 * ::version

 * 0.8.5 (04/26/2013)

 * 

 * ::copyright

 * Copyright (C) 2013 Marin Krmpotic.

 *

 * ::license

 * Licensed under the MIT License.
 
 */



if (isset($_POST['x']) 

&& isset($_POST['y']) 

&& isset($_POST['w'])

&& isset($_POST['h'])

&& isset($_POST['dimension_x'])

&& isset($_POST['image_path'])

&& isset($_POST['image_destination'])) {



$dest = imagecreatetruecolor($_POST['dimension_x'], $_POST['dimension_y']);

$fileType = pathinfo($_POST['image_path'], PATHINFO_EXTENSION);



	switch ($fileType) {

		case "jpg":

		case "jpeg":
		
		case "JPG":

		case "JPEG":

			$src = imagecreatefromjpeg($_POST['image_path']);

			imagecopyresampled($dest, $src, 0, 0, $_POST['x'], $_POST['y'], $_POST['dimension_x'], $_POST['dimension_y'], $_POST['w'], $_POST['h']);

			imagejpeg($dest, $_POST['image_destination'], 100);

			imagedestroy($dest);

			imagedestroy($src);

			break;

		case "png":

		case "PNG":

			$src = imagecreatefrompng($_POST['image_path']);

			imagecopyresampled($dest, $src, 0, 0, $_POST['x'], $_POST['y'], $_POST['dimension_x'], $_POST['dimension_y'], $_POST['w'], $_POST['h']);

			imagepng($dest, $_POST['image_destination']);

			imagedestroy($dest);

			imagedestroy($src);

			break;

		case "gif":

		case "GIF":

			$src = imagecreatefromgif($_POST['image_path']);

			imagecopyresampled($dest, $src, 0, 0, $_POST['x'], $_POST['y'], $_POST['dimension_x'], $_POST['dimension_y'], $_POST['w'], $_POST['h']);

			imagegif($dest, $_POST['image_destination']);

			imagedestroy($dest);

			imagedestroy($src);

			break;

	}

}



?>