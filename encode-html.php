<?php
function encode_html($html, $vname = 'HTMLX') {
    $encoded = base64_encode($html);
    $chunks = str_split($encoded, 64);
    $script = "var $vname =\n\"" . implode("\" +\n\"", $chunks) . "\";\n";
    $script .= "document.write(atob($vname));";
    return "<script>\n$script\n</script>";
}
?>
