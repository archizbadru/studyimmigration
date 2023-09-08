<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CsvRead
{
    function readFile($maxcol = ""){
        
        $count=0;
        $fp = fopen($_FILES['csvupload']['tmp_name'],'r') or die("can't open file");
        
        $rrows = $error = array();
        
        while($rows = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }
         
            for($i = 0, $j = count($rows); $i < $j; $i++)
            {
                 $cols = array();
                 
               
                if(!empty($rows[0]) and !empty($rows[3]) ) {
                
                   for($i = 0; $i <= $maxcol; $i++) {
    					$cols[] = $rows[$i];
					/*	$cols[] = $rows[1];
						$cols[] = $rows[2];
						
						$cols[] = $rows[3];
						$cols[] = $rows[4];
						$cols[] = $rows[5];
						$cols[] = $rows[6];
						$cols[] = $rows[7];
						$cols[] = $rows[8]; */
					}
                  
                }else{
                    
                    //$error[] = "Name"
                }
            }
            if(!empty($cols)) {
                $rrows[] = $cols;
            }
        
        }
      
        
        fclose($fp) or die("can't close file");
            
            return $rrows;
    }
        
    
}