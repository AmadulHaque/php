<?php
    require_once 'vendor/autoload.php';
    use voku\helper\HtmlDomParser;
    // php file exec
    // set_time_limit(0);
    // $ch = curl_init("https://bd.gaadicdn.com/processedimages/yamaha/mt-15-2-0/494X300/mt-15-2-06613f8354e5d9.jpg");
    // $filename = fopen('image.jpg','w');
    // curl_setopt($ch,CURLOPT_FILE,$filename);
    // curl_exec($ch);



    // php dome parse
    function get_word_meaning($word) {
        $endpoint = "https://www.vocabulary.com/dictionary/autocomplete-ss?search={$word}&maxResults=10";
    
        echo "<h1>Meaning of {$word}</h1>";
    
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
    
        if ($result === false) {
            echo "cURL Error: " . curl_error($ch);
            curl_close($ch);
            return;
        }
    
        curl_close($ch);
    
        $dom = HtmlDomParser::str_get_html($result);
    
        if (!$dom) {
            echo "Failed to parse HTML.";
            return;
        }
    
        $short = $dom->findOne('span.definition');
    
        if ($short) {
            echo "<strong>Short Meaning</strong>: " . $short->text();
        } else {
            echo "Definition not found.";
        }
    }
    
    $word = "nice";
    get_word_meaning($word);
    

?>