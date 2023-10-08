
<?php


function view(string $view,array $data = [])
{
    extract($data);
    require __DIR__ . "/../../views/{$view}.php";    
}

function redirect($url, $data = []) {
    if (!empty($data)) {
        session_start();
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        session_write_close();
    }

    if (!headers_sent()) {
        header("Location: $url");
    } else {
        echo "<script>window.location.href='$url';</script>";
    }
    exit();
}



function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}


function auth()
{
	if(isset($_SESSION['token'])){
        return $_SESSION['token'];
    }
	return false;
}