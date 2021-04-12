<?php

 if(isset($_POST['reset'])&& !empty($_POST['category'])){
     header("location:calculateBill.php");
     
 }elseif(isset($_POST['cal']) && !empty($_POST['units']) && !empty($_POST['category']) ){
    ////////////////residential
    if($_POST['category']=='Residential'){
        if($_POST['units']<=30){
            $newcount=($_POST['units']*3); 
            $newpricewithtax=$newcount*125/100;
            $monthlyfixed=30;
            $newprice=$newpricewithtax+$monthlyfixed;
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=25%&used=".$_POST['units']);
            
        }elseif($_POST['units']<=60){
            
            $f30=($_POST['units']-30)*4.70;
            
            $previous=142.50;
            $newpricewithtax=$f30*135/100;
            $monthlyfixed=60;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous; 
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=35%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=90){
            
            $f30=($_POST['units']-60)*7.50;
            
            $previous=332.85;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=90;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous; 
            
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=120){
            
            $f30=($_POST['units']-90)*21;
            
            $previous=737.85;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=315;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous;  
            
        header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=150){
            
            $f30=($_POST['units']-120)*24;
            
            $previous=1934.85;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=315;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=180){
            
            $f30=($_POST['units']-150)*36;
            
            $previous=3257.85;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=315;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
            
        }else{
            $f30=($_POST['units']-180)*40;
            
            $previous=5084.85;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=315;
            
            $newprice=$newpricewithtax+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
    
            
        }
    }
    elseif ($_POST['category']=='Hotel') {
    ////////////hotel
        $f30=($_POST['units'])*21.50;
        $monthlyfixed=600;
        $newprice=$monthlyfixed+$f30;  
        header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
 
    }

//////////////religious///////////////////////////////////////////////////////////////////////////////////////////
    elseif ($_POST['category']=='Religious') {

        if($_POST['units']<=30){
                $newcount=($_POST['units']*1.90); 
                $monthlyfixed=30;
                $newprice=$newcount+$monthlyfixed;
                header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=0%&used=".$_POST['units']);
                
        }elseif($_POST['units']<=90){
            
            $f30=($_POST['units']-30)*2.80;
            
            $previous=87;
            
            $monthlyfixed=60;
            
            $newprice=$f30+$monthlyfixed+$previous; 
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=0%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=120){
            
            $f30=($_POST['units']-90)*6.75;
            
            $previous=315;
            
            $monthlyfixed=180;
            
            $newprice=$f30+$monthlyfixed+$previous; 
            
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=0%&used=".$_POST['units']);
        
        }elseif($_POST['units']<=180){
            
            $f30=($_POST['units']-120)*7.5;
            
            $previous=697.5;
            
            $monthlyfixed=180;
            
            $newprice=$f30+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=0%&used=".$_POST['units']);
        
        }else{
            $f30=($_POST['units']-180)*9.4;
            
            $previous=1327.5;
            
            $monthlyfixed=240;
            
            $newprice=$f30+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=0%&used=".$_POST['units']);
    
            
        }
        
    }
    //////////////industrial///////////////////////////////////////////////////////////////////////////////////////////
    elseif ($_POST['category']=='Industrial') {
        
        if($_POST['units']<=300){
            
            $f30=($_POST['units'])*10.80;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=600;
            
            $newprice=$newpricewithtax+$monthlyfixed;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
            
            
            
        }else{
            $f30=($_POST['units']-300)*12.20;
            $newpricewithtax=$f30*140/100;
            $monthlyfixed=600;
            $previous=5136;
            $newprice=$newpricewithtax+$monthlyfixed+$previous;  
            
            header("location:calculateBill.php?msg=".$newprice."&type=".$_POST['category']."&tax=40%&used=".$_POST['units']);
        }
        
    }


    }else{

        header("location:calculateBill.php?msg=2");

    }

?>





   
