<?php 
	class SortString {
		
		private function moveFile($newname, $tmpfile){

			$target = 'sorted/'.$newname;
			$mv = move_uploaded_file($tmpfile, $target);
			return $target;
		}

		function checkFile($file){

			$info = pathinfo($file['name']);
			$ext = $info['extension'];
			$newname = 'sorted-'.$file['name'];

			return $this->moveFile($newname, $file['tmp_name']);
		}

		function explodeString($target){

			$file = file_get_contents($target);
			$explode = explode("\n", $file);
			$data = [];

			foreach ($explode as $key) {
				
				$_key = explode(" ", $key);
				$_end = end($_key);

				if (strlen($_end) > 0) {
					
					$data[] = ["last_word" => $_end, "full_word" => $key];	
				}
			}

			return $this->sortLine($data, $target);
		}

		private function sortLine($data, $target){

			sort($data);

			$o = fopen($target, "w");
			$no = 0;
			foreach ($data as $key) {
				fwrite($o, $key["full_word"]."\r\n");
			}
			fclose($o);
			
			echo implode("<br>", array_map(function ($arr) {
			  return $arr['full_word'];
			}, $data));
		}
	}
?>