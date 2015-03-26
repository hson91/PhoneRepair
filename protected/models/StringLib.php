<?php
    class StringLib{
        public static function convertToAlias($content, $lower = false){
			$marCoDau=array(
				"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
				"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
				"ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
				"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ");
			$marKoDau=array(
				"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o",
				"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
				"E","E","E","E","E","E","E","E","E","E","E",
				"I","I","I","I","I",
				"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
				"U","U","U","U","U","U","U","U","U","U","U",
				"Y","Y","Y","Y","Y",
				"D");
			$marKyTu = array("`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "=", 
			"\"", "'", ";", ":", ",", "<", ">", ".", "/", "?");
            $content = preg_replace('![=`~\!@#$%^&*\(\)_\"\';:,<>./?]+!', '-', $content);
			$content = str_replace($marCoDau, $marKoDau, $content);
            $content = preg_replace('!\s+!', '-', $content);
            $content = preg_replace('![-]+!', '-', $content);
            $content = rtrim($content,'-');
			return ($lower == true) ? strtolower($content) : $content;
		}
		
        public static function href($cate){
            $href = Yii::app()->getBaseUrl(true);
            if($cate->alias != ''){
                if(strpos($cate->alias, 'http://') == true){
                    $href = $cate->alias;
                }else{
                    if($cate->changes == 1){
                        $href = Yii::app()->baseUrl.'/'.$cate->alias;
                    }else{
                        $parentCate = $cate;
                        while($parentCate->parent_id != 0){
                            $parentCate = $parentCate->cate;
                        }
                        $href = Yii::app()->baseUrl.'/'.$parentCate->alias.'/'.$cate->alias.'.htm';
                    }
                }
            }
            return $href;
        }
    }
?>  