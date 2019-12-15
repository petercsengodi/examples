<?php

$error = "";

$file = $_FILES["galleryImageToUpload"];
$imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
$baseFileName = "-" . time();

$prefix = $sector . "/";
$link = $prefix . "original" . $baseFileName . '.' . $imageFileType;
$thumbnail = $prefix . "thumbnail" . $baseFileName . '.jpg';
$largenail = $prefix . "largenail" . $baseFileName . '.jpg';

$folder = "../images/gallery/";
$originalFile = $folder . $link;
$thumbnailFile = $folder . $thumbnail;
$largenailFile = $folder . $largenail;

$check = getimagesize($file["tmp_name"]);
if ($check === false) {
  $error = "File is not an image: " . $file["tmp_name"];
}

// Check if file already exists
if (!$error && file_exists($originalFile)) {
  $error = "File already exists: " . $originalFile;
}

// Check file size
$allowedSize = 1000000;
if (!$error && $file["size"] > $allowedSize) {
  $error = "File is too large: " . $originalFile . " Size: " . $file["size"] . " Allowed: " . $allowedSize;
}

// Allow certain file formats
if (!$error && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed. Type: " + $imageFileType;
}

if (!$error && !move_uploaded_file($file["tmp_name"], $originalFile)) {
  $error = "Could not move the file: " . $file["tmp_name"] . " to: " . $originalFile;
}

if (!$error) {
  $error = createThumbnail($originalFile, $thumbnailFile, 128, 128);
}

if (!$error) {
  $error = createThumbnail($originalFile, $largenailFile, 800, 600);
}

if ($error) {
  echo "{ error: \"" . $error . "\", mnemonic: \"uploadFailed\" }";
} else {

  include "entity_admin_gallery.php";
  $id = createImage($parentId, $title, $thumbnail, $largenail, $link);
  $info = "The file ". basename($file["name"]). " has been uploaded.";
  echo "{ \"status\": \"ok\", \"info\": \"" . $info . "\", \"result\": { \"id\": \"" . $id . "\" } }";
}

?>

