<?

// @TODO bootstrap for presentation? Build pagination

print "<pre>";

$pi = pathinfo($_SERVER['SCRIPT_FILENAME']);
$path = $pi['dirname'];

showImages($path, false);

function showImages($path, $subdirectory) {
    
    $files = scandir($path, 1);
    
    $piclimit = 50;

    $i = 0;
    foreach ($files as $file) {
        if ($i > $piclimit) exit;
        $fpfile = $path . '/' . $file; // full filepath
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
                            if ($imsize = getimagesize($fpfile)) {
                                $imgsrc = ($subdirectory) ? basename($path) . '/' . $file : $file;
                                echo '<img border="0" width="640" alt="' . $file . '" src="' . $imgsrc . '" /><br /><hr /><br />';
                            }
                        default:
                            // nothing
                    }
                }
        }

        $i++;
    }
}
