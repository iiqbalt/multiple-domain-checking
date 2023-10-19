<?php 
include "console.php";
include "config.php";
include "simple_html_dom.php";

$domains = [
    "google.com",
    "github.com",
    "gitlab.com",
    "facebook.com"
];

$query = [
    //Dont Touch This
    "Unable to connect to remote host",
    "Expiration Date",
    "Expiry Date",

    //Your custom query
    //here...
];

$start = microtime(true);

foreach ($domains as $domain) {
    $html = file_get_html("https://indoip.com/whois/".$domain);
    $content = $html->find('pre')[0];

    foreach ($query as $value) {
        $findKeyPosition = strpos($content, $value);
        $result = substr($content, $findKeyPosition, strlen($value)+12);
        $cleanResult = str_replace(" ", "", $result);

        $date = substr($cleanResult, strlen($value));

        $isDate = Config::validateDate($date);
        if ($isDate) {
            Console::cyan("Domain : ".$domain);
            Console::green("Expired Date : ".$date."\n");
            break;
        }elseif($cleanResult == "Unabletoconnecttoremotehost]</pre>"){
            Console::cyan("Domain : ".$domain);
            Console::red($query[0]."\n");
            break;
        }

    }
}

$end = microtime(true);
Console::complete($domains, ($end-$start));
?>
