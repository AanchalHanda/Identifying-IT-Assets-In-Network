<html>
<head>
	<title>IP ADDRESS PORTAL
         </title>
     </head>
     <body>
     	<style>
          body,html{
               height:100%
          }
     .back
     {     height:100%;
     	background-image: url("min.jpg");
     	background-size: cover;
     	background-repeat: no-repeat;
     }
     input[type=text] {
    width: 50%
    height:20%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}
button[type=submit] {
    background-color:#6396C1;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button[type=submit]:hover {
    background-color: #44ABA7;
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
          <h1 class="top">Enter IP Address Range  to begin the scan.</h1>
          <br>
          <br>
          <form action="basic.php" method="GET">
               <label for="fname" style="font-size: 20px"> Enter Range</label>
               <br>
               <br>
               <input type="text" name="iprange" placeholder="Range...">
               <button type="submit" class="btn btn-block btn-primary" style="display:inline-block">Submit</button>
          </form>
     </div>
 </body>
 </html>