<html>
<head>
  <title>IP ADDRESS PORTAL
         </title>
     </head>
     <body>
      <style>
          body,html{
               height:auto;
          }
     .back
     {     height:auto;
      background-image: url("min.jpg");
      background-size: cover;
      background-repeat: no-repeat;
     }
     .top{
          color:#000000;
          font-family: Britannic Bold;
        font-size: 28px;
     }
     </style>
     <div class="back">
          <br>
          <br>
          <h1 class="top">This is the scanned Result.</h1>
          <br>
          <br>
        <?php

        $bool=true;
        $con=mysqli_connect("localhost", "root", "","ongc") or die (mysql_error()); //Connect to server
            mysqli_select_db($con,"ongc") or die ("Cannot connect to database"); //Connect to database
            
          set_time_limit(0);
          if (isset($_GET['iprange']))
          {
            $iprange = $_GET['iprange'];
          }
          else $iprange = "192.168.43.220-225";

          $explodedarray =explode('-',$iprange) ;
          $loopend =  $explodedarray[1];

          $explodedarray2 = explode('.' , $explodedarray[0]);
          $ippart1 =  $explodedarray2[0];
          $ippart2 =  $explodedarray2[1];
          $ippart3 = $explodedarray2[2];
          $loopbegin = $explodedarray2[3];
           $mine=13;
          $i=$loopbegin;
          for($i;$i<=$loopend;)
          {
            $ip = $ippart1.'.'.$ippart2.'.'.$ippart3.'.'.$i;
            //echo $ip.'</br>';
            $query = 'ping -n 1'.' '.$ip;
            //echo $query.'</br>';
            
            $pingoutput = shell_exec($query);
            $matchtext = "Pinging with 32 bytes of data:
            Reply from : bytes=32 time< TTL=
            Ping statistics for :
            Packets: Sent = 1, Received = 1, Lost = 0 (0% loss),
            Approximate round trip times in milli-seconds:
            Minimum = 0ms, Maximum = 0ms, Average = 0ms";
            similar_text($pingoutput, $matchtext, $percentage);

            if ($percentage >=80)
            {
              //echo 'Host is up , IP address :'.$ip.'</br>';
               if($i==$mine)
               {  $manufacturerquery = 'wmic computersystem get Manufacturer';
              $usernamequery = 'wmic computersystem get username';
              $osquery = 'wmic os get caption,version';
              $drivequery = 'wmic memorychip get devicelocator , capacity';
              $logicaldisk = 'wmic logicaldisk get name,filesystem';
              $printer = 'wmic printer get name,deviceid';
              $printjob = 'wmic printerjob get document,description';
              $cpu = 'wmic cpu get Name, Caption, MaxClockSpeed';
              $serialno = 'wmic  os get serialnumber';
               $manufacturerqueryshell = shell_exec($manufacturerquery);
                $usernameshell = shell_exec($usernamequery);
                 $osqueryshell=shell_exec($osquery);
                 $drivequeryshell=shell_exec($drivequery);
                 $logicaldiskshell=shell_exec($logicaldisk);

              $printershell = shell_exec($printer);
              $printjobshell= shell_exec($printjob);
              $cpushell=shell_exec($cpu);
              $serialnumbershell=shell_exec($serialno);

              


               }
            else {
              $manufacturerquery = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc computersystem get Manufacturer';
              $usernamequery = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc computersystem get username';
              $osquery = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc os get caption,version';
              $drivequery = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc memorychip get devicelocator , capacity';
              $logicaldisk = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc logicaldisk get name,filesystem';
              $printer = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc printer get name,deviceid';
              $printjob = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc printerjob get document,description';
              $cpu = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc cpu get Name, Caption, MaxClockSpeed';
              $serialno = 'wmic /node:'.$ip.'/USER:"'.$ip.'\ongc" /PASSWORD:ongc os get serialnumber';

              $manufacturerqueryshell = shell_exec($manufacturerquery);
              if(strlen($manufacturerqueryshell)==4){

              $manufacturerqueryshell = shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "dmidecode -s system-manufacturer"');


              }

              $usernameshell = shell_exec($usernamequery);
              if(strlen($usernameshell)==4){
              $usernameshell=shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "whoami"');

              }
              $osqueryshell=shell_exec($osquery);
              if(strlen($osqueryshell)==4){
              $osqueryshell=shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "lsb_release -a"');

              }
              $drivequeryshell=shell_exec($drivequery);
              if(strlen($drivequeryshell)==4){
              $drivequeryshell='<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "free"').'</pre>';

              }
              $logicaldiskshell=shell_exec($logicaldisk);


              $printershell = shell_exec($printer);
              $printjobshell= shell_exec($printjob);
              $cpushell=shell_exec($cpu);
              $vgaquery = '"lspci  -v -s  $(lspci | grep " VGA " | cut -d" " -f 1)"'."'";
              $vgashell='<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C '.$vgaquery).'</pre>';
              if(strlen($cpushell)==4){
              $cpushell='<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "dmidecode -s  processor-version"').'</pre>';

              }
              $serialnumbershell=shell_exec($serialno);
              if(strlen($serialnumbershell)==4){
              $serialnumbershell='<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "dmidecode -s system-serial-number"').'</pre>';

              }
              //$mountedfilesystem = '<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "findmnt -lo source,target,fstype,label,options,used -t ext4"').'</pre>';
              //$availusers =  '<pre>'.shell_exec('plink.exe root@'.$ip.' -pw ongc123 -C "getent passwd"').'</pre>';
                }
          
              $insertquery = mysqli_query($con,"INSERT INTO info (`ip`, `manufacturer`,`hostname`, `os`, `processor`, `ram`, `localdd`, `printer`, `ssn`, `updown`, `uid`) VALUES('$ip' ,'$manufacturerqueryshell','$usernameshell','$osqueryshell','$cpushell','$drivequeryshell','$logicaldiskshell','$printershell','$serialnumbershell','UP','')");
              
              echo "<h2>Details for ".$ip."</h1>";
              echo "<br>";
              echo "<h3>Manufacturer</h3>";
              echo  $manufacturerqueryshell;
              echo "<h3>Hostname</h3>";
              echo $usernameshell;
              echo "<h3>OS</h3>";
              echo $osqueryshell;
                echo "<h3>Drive</h3>";
                echo $drivequeryshell;
                echo "<h3>Logical Disk</h3>";
                echo $logicaldiskshell;
                 echo "<h3>Printer</h3>";
                  echo $printershell;
                  echo "<h3>CPU</h3>";
                  echo $cpushell;
                  echo "<h3>Serial Number</h3>";
                  echo $serialnumbershell;
            }
            else if($percentage<80)
            {
              
                echo "<h2>Details for ".$ip."</h2>";
                echo "Host Is Down";
            }
            
            $i=$i+1;
          }//for loop ends          

        ?>
     </div>
 </body>
 </html>