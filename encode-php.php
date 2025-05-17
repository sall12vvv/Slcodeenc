<?php
function encode_php($code, $layers = 1, $v1 = 'XNXX', $v2 = 'CODE') {
    for ($i = 0; $i < $layers; $i++) {
        $code = base64_encode($code);
    }

    $chunks1 = str_split($code, 64);
    $var1 = '$' . $v1 . " =\n\"" . implode("\".\n\"", $chunks1) . "\";\n";

    $eval_code = "eval(base64_decode(\$$v1));";
    for ($i = 0; $i < $layers; $i++) {
        $eval_code = base64_encode($eval_code);
    }

    $chunks2 = str_split($eval_code, 64);
    $var2 = '$' . $v2 . " =\n\"" . implode("\".\n\"", $chunks2) . "\";\n";

    return "<?php\n\n// Order script no encrypt\n// Create By Kiki Hostinger\n\n$var1\n$var2\neval(base64_decode($$v2));\n?>";
}
?>
