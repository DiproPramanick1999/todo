<!--
<?php

$user = $this->session->all_userdata();
if($user['id']!=""){
    redirect(base_url()."todo/home");
}

?>-->
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>To-Do</title>
        <link rel = "icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png">
        <!-- For apple devices -->
        <link rel = "apple-touch-icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>        
        <!-- Custom-Files -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>front_static/css/bootstrap.css">
        <!-- Bootstrap-Core-CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>front_static/css/style.css" type="text/css" media="all" />
        <!-- Style-CSS -->
        <!-- font-awesome-icons -->
        <link href="<?php echo base_url(); ?>front_static/css/font-awesome.css" rel="stylesheet">
        <!-- //font-awesome-icons -->
        <!-- /Fonts -->
       <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
       <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
       <style>
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            /* box-shadow: inset 0 0 5px grey; */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #65656B;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #65656B;
        }

        .task-view:hover{
            cursor: pointer;
        }

        #del{
            background-color:#31313A;
            border:none;
            color:rgba(255,255,255,0.5);
        }

        #del:hover{
            cursor: pointer;
        }

        .task_complete:hover{
            background-color:#26262D;
        }
        
        label{
              color:#657ae6!important;
           }
       </style>
        <!-- //Fonts -->        
    </head>

    <body style="background-color:#26262D;">
        <!-- header -->
        <?php include __DIR__."/../todo/header.php" ?>
        <!-- //header -->
        <!-- page details -->
        <div class="breadcrumb-agile">
        	<ol class="breadcrumb mb-0">
        		<li class="breadcrumb-item">
        			<a href="<?php echo base_url(); ?>">Home</a>
        		</li>
        		<li class="breadcrumb-item active" aria-current="page">SignUp</li>
        	</ol>
        </div>
        <!-- //page details -->
        <!-- //banner-botttom -->
        <section class="content-info py-5">
            <div class="container py-md-5">
                <div class="row">
                    <div class="col-md-5" style="background-color:#e8c00c;">
                       <div class="row">
                        <img class="img-responsive" src="<?php echo base_url(); ?>front_static/images/signup.svg" alt="" width="500" height="600">
                    </div>
                    </div>
                    <div class="col-md-7" id="signup" style="background-color:#31313A;border-left:1px solid black;">
                        <div class="container" style="margin-top:50px;">
                            <div class="row task-view">
                                <div class="col-lg-12" style="margin-top:3px;height:600px;overflow-y:scroll;">                                                                           
                                    <div id="task-body">
                                           
                                            <h2 style="color:#e8c00c;" align="center">Sign Up</h2>
                                            
                                        <form class="w3layouts-contact-fm" method="post" action="<?php echo base_url(); ?>login/signup/form_val" >
                                              <p class="text-danger"><?php echo form_error("confirm_password"); ?></p>
                                              <p class="text-danger"><?php echo form_error("email_id"); ?></p>
                                              <p class="text-danger"><?php echo form_error("phone_no"); ?></p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="dipro" for="first_name">First Name</label>
                                                            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter First Name"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name</label>
                                                            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter Last Name" required>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="email_id">Email Id</label>
                                                            
                                                            <input class="form-control" type="email" name="email_id" id="email_id" placeholder="Enter Email-id"required>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="phone_no">Phone Number</label>
                                                            <input class="form-control" type="number" name="phone_no" id="phone_no" placeholder="Enter Phone Number"required>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="confirm_password">Confirm Password</label>
                                                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" required>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                     <div class="col-md-12" style="margin-bottom:10px">
                                                        <button type="submit" name="insert" value="Insert" id="buttn" style="background-color:#e8c00c;" class="btn float-right btn-block">Sign Up</button>
                                                    </div>
                                                    </div>
                                            </form>
                                        
                                    
                                    </div>                                                                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- //banner-botttom -->
        <!-- footer -->
        <?php include __DIR__."/../todo/footer.php"?>
        <!-- //footer -->
    </body>
</html>
