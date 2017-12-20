<?php
/**
 * Created by PhpStorm.
 * User: Ahmi
 * Date: 12/19/2017
 * Time: 8:04 PM
 */

$route = array(
        "Ali Town",
    "Thokar Niaz Baig", "Canal View", "Hanjarwal", "Wahdat Road", "Awan Town", "Sabzazar", "Shahnoor","Salahuddin Road","Bund Road","Samanabad","Gulshan-e-Ravi","Chauburji","Lake Road","GPO","Lakshami","Railway Station","Sultanpura","UET","Baghbanpura","Shalimar Garden","Pakistan Mint","Mahmood Booti", "Islam Park", "Salamat Pura", "Dera Gujran");
$error = false;

$errorMsg = null;
$msg =null;
$con = new mysqli('localhost', 'root', '', 'test');
if ($con->connect_error) {
    die("Connection is Not Established " . $con->connect_error);
} else {
    if(isset($_POST['update'])){
        $ticketNo = $_POST['ticketNo'];
        $passengerName = $_POST['passengerName'];
        $gender = $_POST['gender'];
        $reservationDate = $_POST['reservationDate'];
        $to = $_POST['to'];
        $from = $_POST['from'];
        $email = $_POST['email'];
        $cardNo = $_POST['cardNo'];
        $cvc = $_POST['cvc'];
        $cardHolderName = $_POST['cardHolderName'];
        $cardExpireDate = $_POST['cardExpireDate'];

        $query = "Update ticket Set passengerName='$passengerName',gender='$gender',reservationDate='$reservationDate',pickup='$from',dropOff='$to',email='$email',cardNo='$cardNo',cvc='$cvc',cardHolderName='$cardHolderName',cardExpireDate='$cardExpireDate' where ticketNo='$ticketNo' ";
        if(!isset($gender)){
            $error = true;
            $errorMsg = "Please Select Gender";
        }elseif(!isset($reservationDate)) {
            $error=true;
            $errorMsg = "Please Select Reservation Date";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error=true;
            $errorMsg = "Please Enter Correct Email Address";
        }
        elseif(!preg_match('/^\d{15}$/', $cardNo)){
            $error = true;
            $errorMsg = "Please Enter 15 Digit Card No";
        }elseif(!is_numeric($cardNo)){
            $error = true;
            $errorMsg = "Card No Must be Numeric";
        }elseif (!is_numeric($cvc)){
            $error = true;
            $errorMsg = "CVC Must be Numeric";
        }elseif(!preg_match('/^\d{3}$/', $cvc)){
            $error = true;
            $errorMsg = "Please Enter 3 Digit CVC";
        }else{
            $con->query($query);
            $msg = "Update Successfully";

        }

    }
    if(isset($_POST['delete'])){
        $ticketNo = $_POST['ticketNo'];
        $query = "delete from ticket where ticketNo='$ticketNo'";
        $con->query($query);
        $msg="Record Successfully Delete";
    }
    if (isset($_POST['submit'])) {
         $passengerName = $_POST['passengerName'];

         $gender = $_POST['gender'];
         $reservationDate = $_POST['reservationDate'];
         $to = $_POST['to'];
         $from = $_POST['from'];
         $email = $_POST['email'];
         $cardNo = $_POST['cardNo'];
         $cvc = $_POST['cvc'];
         $cardHolderName = $_POST['cardHolderName'];
         $cardExpireDate = $_POST['cardExpireDate'];
        $query = "insert into ticket(passengerName,gender,reservationDate,pickup,dropOff,email,cardNo,cvc,cardHolderName,cardExpireDate) VALUES ('$passengerName','$gender','$reservationDate','$from','$to','$email','$cardNo','$cvc','$cardHolderName','$cardExpireDate')";
        if(!isset($gender)){
            $error = true;
            $errorMsg = "Please Select Gender";
        }elseif(!isset($reservationDate)) {
            $error=true;
            $errorMsg = "Please Select Reservation Date";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error=true;
            $errorMsg = "Please Enter Correct Email Address";
        }
        elseif(!preg_match('/^\d{15}$/', $cardNo)){
            $error = true;
            $errorMsg = "Please Enter 15 Digit Card No";
        }elseif(!is_numeric($cardNo)){
            $error = true;
            $errorMsg = "Card No Must be Numeric";
        }elseif (!is_numeric($cvc)){
            $error = true;
            $errorMsg = "CVC Must be Numeric";
        }elseif(!preg_match('/^\d{3}$/', $cvc)){
            $error = true;
            $errorMsg = "Please Enter 3 Digit CVC";
        }else{
            $con->query($query);
            $msg = "Reserved Successfully";

        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link href="CSS/style.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <style>
        .table-striped>tbody>tr:nth-of-type(odd){
            background-color:#424242;
        }
    </style>
</head>
<body>
<div id="app">
    <v-app id="inspire" dark>
        <v-navigation-drawer
                clipped
                fixed
                v-model="drawer"
                app
        >
            <v-list dense>
                <form action="" method="post">
                    <v-btn style="margin: 0; padding: 0; width: 100%;" flat type="submit" name="reservation">
                <v-list-tile >
                    <v-list-tile-action>
                        <v-icon>add_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Reservation</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                    </v-btn>
                    <v-btn style="margin: 0; padding: 0; width: 100%;" flat type="submit" name="status">
                        <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>settings</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Check Reservation</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                    </v-btn>
                </form>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app fixed clipped-left class="deep-orange lighten-1
">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Assignment</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fill-height>
                <v-layout justify-center align-center>
                    <v-dialog v-model="deleteAlert" max-width="290">
                        <form action="" method="post">
                        <v-card>
                            <v-card-title class="headline">Are you sure you want to permanently delete record of ticket No <input type="text" readonly name="ticketNo" :value="ticketNo"> ?</v-card-title>

                            <v-card-actions>

                                <v-spacer></v-spacer>
                                <v-btn color="green darken-3" flat="flat" @click.native="deleteAlert = false">No</v-btn>

                                                            <v-btn color="red darken-1" flat="flat" type="submit" name="delete" >Yes</v-btn>

                            </v-card-actions>
                        </v-card>
                        </form>
                    </v-dialog>
                    <?php if($error || isset($msg)){?>
                    <v-dialog v-model="dialog" max-width="290">
                        <?php if(isset($msg)){ ?>
                        <v-alert color="success" icon="check_circle" value="true">
                            <?php echo $msg?>
                        </v-alert>
                        <?php }elseif($error){?>
                        <v-alert color="error" icon="warning" value="true">
                            <?php echo $errorMsg;?>
                        </v-alert>
                        <?php }?>
                    </v-dialog>
                        <?php }if(isset($_POST['reservation'])){?>

                    <form  style="width: 500px"  method="post" >
                        <v-text-field
                                required
                                label="Passenger Name"
                                name="passengerName"
                                class="row"
                        ></v-text-field>

                        <v-radio-group row class="row"  >
                            <v-radio label="Female"  name="gender" value="female" ></v-radio>
                            <v-radio label="Male"  name="gender" value="male"></v-radio>
                        </v-radio-group>

                        <v-flex xs11 sm5>
                            <v-dialog
                                    persistent
                                    lazy
                                    full-width
                                    width="290px"
                            >
                                <v-text-field
                                        v-model="date"
                                        required
                                        class="row"
                                        slot="activator"
                                        label="Reservation Date"
                                        prepend-icon="event"
                                        name="reservationDate"
                                        readonly
                                ></v-text-field>
                                <v-date-picker v-model="date" scrollable actions>
                                    <template slot-scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
                                            <v-btn flat color="primary" @click="save">OK</v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-date-picker>
                            </v-dialog>
                        </v-flex>


                        <div class="form-group row">
                            <div style="width: 250px;">
                                <label for="from">From:</label>
                                <select class="form-control" name="from" style="background: #303030; color:white" >
                                    <?php
                                    foreach($route as $name){
                                        echo "<option>$name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <v-spacer></v-spacer>
                            <div style="width: 250px">
                                <label for="to">To:</label>
                                <select class="form-control" name="to" style="background: #303030; color:white" >
                                    <?php
                                    foreach($route as $name){
                                        echo "<option>$name</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <v-text-field
                                required
                                label="E-mail"
                                name="email"
                                class="row"
                        ></v-text-field>
                        <div class="row">
                            <v-flex
                                    xs9
                            >

                                    <v-text-field
                                            required
                                            :rules="cardRules"
                                            label="Card No"
                                            name="cardNo"
                                            :counter="15"
                                    ></v-text-field>
                            </v-flex>
                        <v-text-field class="ml-1"
                                      required
                                      :rules="cvcRules"
                                      label="CVC"
                                      name="cvc"
                                      :counter="3"
                        >

                        </v-text-field>
                        </div>
                        <div class="row">
                            <v-text-field
                                    required
                                    label="Card Holder Name"
                                    name="cardHolderName"

                            ></v-text-field>
                            <v-flex xs11 sm5 class="ml-2">
                                <v-dialog
                                        persistent
                                        lazy
                                        full-width
                                        width="290px"
                                >
                                    <v-text-field
                                            required
                                            slot="activator"
                                            v-model="expireDate"
                                            label="Card Expire Date"
                                            prepend-icon="event"
                                            name="cardExpireDate"
                                            readonly
                                    ></v-text-field>
                                    <v-date-picker v-model="expireDate" scrollable actions>
                                        <template slot-scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
                                                <v-btn flat color="primary" @click="save">OK</v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-date-picker>
                                </v-dialog>
                            </v-flex>
                        </div>

                        <v-btn  type="submit" name="submit">submit</v-btn>
                    </form>
                    <?php }?>

                        <?php if(isset($_POST['status'])) {?>
                            <table id="reservationInfo" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Ticket No</th>
                                    <th>Passenger Name</th>
                                    <th>Gender</th>
                                    <th>Reservation Date</th>
                                    <th>From</th>
                                    <th>TO</th>
                                    <th>Email</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!--Read Data From Database-->
                                <?php
                                $query = "Select * From ticket";
                                $result = $con->query($query);
                                if($result->num_rows > 0){
                                    while ($row = mysqli_fetch_assoc($result)){?>

                                <tr>
                                    <td><?php echo $row['ticketNo']?></td>
                                    <td><?php echo $row['passengerName']?></td>
                                    <td><?php echo $row['gender']?></td>
                                    <td><?php echo $row['reservationDate']?></td>
                                    <td><?php echo $row['pickup']?></td>
                                    <td><?php echo $row['dropOff']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td>
                                    <form action="" method="post">
                                        <v-btn fab dark  type="submit" name="edit" value="<?php echo $row['ticketNo']?>" small color="cyan">
                                                <v-icon dark>edit</v-icon>
                                            </v-btn>
                                    </form>
                                    </td>
                                    <td>
                                            <v-btn  id="delete" fab dark color="red" v-on:click="deleteRecord(<?php echo $row['ticketNo']?>)"  small color="cyan">
                                                <v-icon dark >delete</v-icon>
                                            </v-btn>

                                    </td>
                                </tr>

                                    <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        <?php }?>

                    <!--Edit Data -->
                    <?php

                    if(isset($_POST['edit'])){
                        $ticketNo=$_POST['edit'];
                        $query = "Select * From ticket where ticketNo = '$ticketNo'";
                        $result = $con->query($query);

                        if($result->num_rows > 0){
                            $row = mysqli_fetch_assoc($result);


                            ?>
                            <form style="width:550px;" method="post">
                                <div class="form-group">
                                    <label for="ticketNo">Ticket No</label>
                                    <input type="text" name="ticketNo" class="form-control" readonly value="<?php echo $row['ticketNo'];?>" placeholder="name@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="Passenger Name">Passenger Name</label>
                                    <input type="text" name="passengerName" class="form-control" value="<?php echo $row['passengerName'];?>" placeholder="name@example.com">
                                </div>
                                <div class="radio">
                                    <label class="radio-inline"><input type="radio" <?php if($row['gender'] =="female"){echo "checked";}?> name="gender" value="female">Female</label>
                                    <label class="radio-inline"><input type="radio" <?php if($row['gender'] =="male"){echo "checked";}?> name="gender" value="male">Male</label>
                                </div>
                                <div class="form-group">
                                    <label for="date">Reservation Date:</label>
                                    <input type="date" name="reservationDate" class="form-control" value="<?php echo $row['reservationDate'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="From">From</label>
                                    <select class="form-control" name="from" >
                                        <?php echo "<option>".$row['pickup']."</option>";?>
                                        <?php
                                        foreach($route as $name){
                                            if($row['pickup'] == $name){
                                                echo "<option selected='selected'>$name</option>";
                                            }else{
                                                echo "<option>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="to">To</label>
                                    <select class="form-control" name="to">
                                        <?php
                                        foreach($route as $name){
                                            if($row['dropOff'] == $name){
                                                echo "<option selected='selected'>$name</option>";
                                            }else{
                                                echo "<option>$name</option>";
                                            }

                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="Card No">Card No</label>
                                    <input type="text" name="cardNo" class="form-control" value="<?php echo $row['cardNo'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="CVC">CVC</label>
                                    <input type="number" name="cvc" class="form-control" value="<?php echo $row['cvc'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="carHolderName">Card Holder Name</label>
                                    <input type="text" name="cardHolderName" class="form-control" value="<?php echo $row['cardHolderName'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="expireDate">Expire Date</label>
                                    <input type="date" name="cardExpireDate" class="form-control" value="<?php echo $row['cardExpireDate'];?>">
                                </div>
                                <v-btn flat type="submit"  color="primary" name="update">Update</v-btn>
                            </form>
                            <?php

                        }
                    }

                    ?>
                </v-layout>

            </v-container>

        </v-content>
        <v-footer app fixed class="deep-orange lighten-1">
            <v-spacer></v-spacer>
            <span>&copy; 2017</span>
        </v-footer>
    </v-app>
</div>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="JS/vue.js"></script>
<script src="JS/js.js"></script>
<script>
    $(document).ready(function() {
        $('#reservationInfo').DataTable();
    } );
</script>
<script>
    new Vue({
        el: '#app',


        data: {

            reservation:true,
            deleteAlert:false,
            dialog:true,
            drawer: null,
            date: null,
            expireDate: null,
            menu: false,
            modal: false,
            cardNo:'',
            cvc:'',
            ticketNo:null,
            cardRules: [
        (v) => v.length == 15 || 'Card No must be 15 digit'
    ],

    cvcRules: [
        (v) => v.length == 3 || 'CVC must be 3 digit'
    ]
        },
    methods: {
        deleteRecord: function (message) {

           this.deleteAlert = true;
           this.ticketNo = message;
        }
    }





    })


</script>
</body>
</html>