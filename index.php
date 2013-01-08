<?
// Just put this anywhere you store the pics, it'll recurse but it's not at all efficient
print "<pre>";

$pi = pathinfo($_SERVER['SCRIPT_FILENAME']);
$path = $pi['dirname'];

showImages($path, false);

function showImages($path, $subdirectory) {
    //echo "<br />\nShowing images for: " . $path;
    //$d = dir($path);
    //while(false !== ($file = $d->read())) {
    $files = scandir($path, 1);
    foreach ($files as $file) {

        $fpfile = $path . '/' . $file; // full filepath
        //echo "\n<br />Switching file: " . $file;
        switch($file) {
            case ".":
            case "..":

            break;

            default:
                if (is_dir($file)) {
                    showImages($fpfile, true);
                } elseif (is_file($fpfile)) {
                    $fpi = pathinfo($fpfile);
                    switch($fpi['extension']) { 
                        case "jpg":
                        case "gif":
                        case "jpeg":
                        case "png":
                            //echo "\n<br />show file: " . $fpfile . " -- " . basename($path);
                            if ($imsize = getimagesize($fpfile)) {
                                $imgsrc = ($subdirectory) ? basename($path) . '/' . $file : $file;
                                echo '<img border="0" width="640" alt="' . $file . '" src="' . $imgsrc . '" /><br /><hr /><br />';
                            }
                        default:
                            // nothing
                    }
                }
        }

    }

}
