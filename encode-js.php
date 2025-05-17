<?php
function encode_js($code, $layers = 1, $v1 = 'JSX', $v2 = 'JSRun') {
    for ($i = 0; $i < $layers; $i++) {
        $code = base64_encode($code);
    }

    $chunks1 = str_split($code, 64);
    $var1 = "var $v1 =\n\"" . implode("\" +\n\"", $chunks1) . "\";\n";

    $eval_code = "eval(atob($v1));";
    for ($i = 0; $i < $layers; $i++) {
        $eval_code = base64_encode($eval_code);
    }

    $chunks2 = str_split($eval_code, 64);
    $var2 = "var $v2 =\n\"" . implode("\" +\n\"", $chunks2) . "\";\n";

    return "// Obfuscated JavaScript\n$var1\n$var2\neval(atob($v2));";
}
?>
