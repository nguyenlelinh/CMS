<?php 
function debug($data, $die = true)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($die) die();
}

function sendMessage($mess, $status = false, $url = "")
{
    $result = [
        'status' => $status,
        'mess' => $mess
    ];
    if ($url != "") $result["url"] = $url;
    json($result);
}

function json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    die();
}

function randomString($length = 10): string
{
    return strval(substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length));
}
function randomColor() : string
{
    return "#".strval(substr(str_shuffle(str_repeat($chars = 'ABCDEF0123456789', ceil(6 / strlen($chars)))), 1, 6));
}

function encryptString($string, $key=ENCRYPT_KEY): string
{
    return md5(sha1(base64_encode($string . $key)));
}

function prettyURL($string): string
{
    if($string){
        $string = trim(mb_strtolower($string));
        $string = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $string);
        $string = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $string);
        $string = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $string);
        $string = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $string);
        $string = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $string);
        $string = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $string);
        $string = preg_replace('/(đ)/', 'd', $string);
        $string = preg_replace('/[^a-z0-9-\s]/', '-', $string);
        $string = preg_replace('/(\s+)/', '-', $string);
        $string = preg_replace('/\--+/', '-', $string);
        $string = $string[0] === '-' ? ltrim($string, '-') : $string;
        return ($string[-1] === '-') ? rtrim($string, '-') : $string;
    }else return false;
}

function vnPhoneNumberCheck($string): string
{
    $number = preg_replace('/[\s\)\(]*/', '', $string);
    $regex = "/(^|\+)(84|0)([3|5|7|8|9])([0-9]{8})$/";
    preg_match($regex, $number, $matches);
    if(empty($matches)) return false;
    else {
        if($matches[2]=="84") {
            if($matches[1]=="") return false;
        }else{
            if($matches[1]!="") return false;
        }
        $matches[2] = "+84";
        return $matches[2].$matches[3].$matches[4];
    }
}

// --------------------------------------------------------------------

if ( ! function_exists('remove_invisible_characters'))
{
	/**
	 * Remove Invisible Characters
	 *
	 * This prevents sandwiching null characters
	 * between ascii characters, like Java\0script.
	 *
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/i';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/i';	// url encoded 16-31
			$non_displayables[] = '/%7f/i';	// url encoded 127
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}