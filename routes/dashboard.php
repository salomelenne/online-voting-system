<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}
$userdata=$_SESSION['userdata'];
$groupsdata=$_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status='<b "style=color:red"> Not voted</b>';
}
else{
    $status='<b "style=color:green"> Voted</b>';
}
?>
<html>
    <center> <head><title>Online Voting System DashBoard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
    <body>
        <style> 
    #backbtn{
        padding: 5px;
    border-radius: 5px;
    background-color: blue;
    color: white;
    font-size: 15px;
    float: left;
    margin: 10px;
    }
    #logoutbtn{
        padding: 5px;
    border-radius: 5px;
    background-color: blue;
    color: white;
    font-size: 15px;
    float: right;
    margin: 10px;

    }
    #profile{
        background:white;
        width:30%;
        padding:20px;
        float:left;
    }
    #group{
        background:white;
        width:60%;
        padding:20px;
        float:right;
    }
    #votebtn{
        padding: 5px;
    border-radius: 5px;
    background-color: blue;
    color: white;
    font-size: 15px;
    float: left;
    }
    #mainpanel{
        padding: 10px;
    }
    #mainSection{
        padding: 10px;
 
    }
    #voted{
        padding: 5px;
    border-radius: 5px;
    background-color: green;
    color: white;
    font-size: 15px;
    float: left;
    }
    </style>
    <div id="mainSection">
    <a href="../"><button id=backbtn >Back</button></a>   
    <a href="logout.php"><button id=logoutbtn> Logout</button></a> 
    <h1>Online Voting System</h1>
    </div></center>
   
    <hr>
    <div id="mainpanel">    <div id="group">
        <?php
        if($_SESSION['groupsdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>
                <div>
                    <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                    <b>Group Name:</b><?php echo $groupsdata[$i]['name'] ?><br><br>
                    <b>Votes:</b><?php echo $groupsdata[$i]['votes'] ?><br><br>
                    <form action="../api/vote.php" method="POST" >
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                        
                        <?php
                        if($_SESSION['userdata']['status']==0){
                            ?>
                            <input type="submit" name="votebtn" value="Vote" id="votebtn"><br><br>
                            <?php
                        }
                        else{
                            ?>
                            <button disabled type="submit" name="votebtn" value="Vote" id="voted">Voted</button<br><br>
                        <?php
                        }
                        ?>
            </form>
            </div>
            <br><br>
            <hr>
            <?php

            }
        }
        else{

        }
        ?>
    </div></div>
    <div id="profile">
       <center> <img src="../uploads/<?php echo $userdata['photo']?>" height="200" width="200"></center><br><br>
        <b>Name:</b><?php echo $userdata['name'] ?><br><br>
        <b>Mobile:</b><?php echo $userdata['mobile'] ?><br><br>
        <b>Adress:</b><?php echo $userdata['adress'] ?><br><br>
        <b>Status:</b><?php echo $status ?><br><br>
    </div>

    </div>

</body>

</html>