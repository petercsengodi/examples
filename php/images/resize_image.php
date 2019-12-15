<?php

function createThumbnail($sourceFile, $targetFile, $maxWidth, $maxHeight) {
  if(!file_exists($sourceFile)){
    return "Not exists: " . $sourceFile;
  }

  $size = getimagesize($sourceFile);

  $fp = fopen($sourceFile, "rb");
  if ($size && $fp) {
    $oldWidth = $size[0];
    $oldHeight = $size[1];
    $xRatio = min(1, $maxWidth / $oldWidth);
    $yRatio = min(1, $maxHeight / $oldHeight);
    $ratio = min($xRatio, $yRatio);

    $newWidth = $ratio * $oldWidth;
    $newHeight = $ratio * $oldHeight;

    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    $source = imagecreatefromjpeg($sourceFile);
    fclose($fp);

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

    imagejpeg($thumb, $targetFile);
    imagedestroy($thumb);
    imagedestroy($source);
    return '';
  } else {
    return "Not open or source missing: " . $sourceFile;
  }
}

?>
