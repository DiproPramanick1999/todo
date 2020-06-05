<?php
    // if ($this->session->userdata("userid") != "") {
    //   redirect(base_url()."dashboard");
    // }
    // if ($this->session->flashdata("signup")) {
    //   echo "<script>alert('Registered Successfully. Please login to Continue');</script>";
    // }
    // if ($this->session->flashdata("password")) {
    //   echo "<script>alert('Password Changed Successfully. Please login to Continue');</script>";
    // }
$user = $this->session->all_userdata();
if($user['id']==""){
    redirect(base_url()."login/login");
}
else{
    $_SESSION['view'] = 1;
}


 ?>
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

        #ele_task:hover{
            text-decoration: underline;
        }

        .completed{
            text-decoration: line-through;
        }

       </style>
        <!-- //Fonts -->        
    </head>

    <body style="background-color:#26262D;">
        <!-- header -->
        <?php include "header.php" ?>
        <!-- //header -->
        <!-- page details -->
        <div class="breadcrumb-agile">
        	<ol class="breadcrumb mb-0">
        		<li class="breadcrumb-item">
        			<a href="<?php echo base_url(); ?>">Home</a>
        		</li>
        		<li class="breadcrumb-item active" aria-current="page">Todo</li>
        	</ol>
        </div>
        <!-- //page details -->
        <!-- //banner-botttom -->
        <section class="content-info py-5">
            <div class="container py-md-5">
                <div class="row">
                    <div class="col-md-5" style="background-color:#31313A;">
                        <h3 style="color:white; margin-top:25px;" align="center">Add New To-Do</h3>
                        <div class="row" style="margin-top:15px;">
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="add_task">Task</label>                                    
                                        <input class="form-control" type="text" name="task" id="add_task" placeholder="Enter Task">
                                    </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="add_due">Due Date</label>
                                        <input class="form-control" type="date" id="add_due"  placeholder="Enter Date" >
                                    </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="add_label">Label</label>                                        
                                        <select name="" id="add_label" class="form-control" onchange="labelFun()">
                                            <option value="personal">Personal</option>
                                            <option value="work">Work</option>
                                            <option value="shopping">Shopping</option>
                                            <option value="others">Others</option>
                                          <!-- <?php foreach($labels as $values){?>
                                            <option value="<?php echo $values["label"];?>"><?php echo ucwords($values["label"]);?></option>
                                          <?php }?> -->
                                        </select>
                                    </div>
                            </div>                            
                            <div class="col-lg-12" id="add_others_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="add_others">Others</label>
                                        <input class="form-control" type="text" id="add_others"  placeholder="Enter Label" >
                                    </div>
                                    <script>
                                        function labelFun(){                                            
                                            if($("#add_label").val() == "others"){                                                
                                                $("#add_others_div").show();
                                            }else{
                                                $("#add_others_div").hide();
                                            }
                                        }
                                    </script>
                            </div>                                                                        
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-block btn-danger" id="add_btn">Add To-Do</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        let tasks = [<?php echo json_encode($tasks);?>][0]; 
                        if(!tasks.length){
                            tasks = [];
                        }                                               
                        $("#add_btn").click(function(){    
                            var lab = $("#add_label").val();
                            if(lab == "others"){
                                lab = $("#add_others").val()
                            }
                            $.ajax({
                                url: '<?php echo base_url();?>todo/add',
                                type: "POST",
                                data : {
                                    'task' : $("#add_task").val(),
                                    'due' : $("#add_due").val(),
                                    'label' : lab,
                                },
                                success: function(data){
                                    // console.log(tasks);
                                    data = JSON.parse(data);
                                    var new_data  = {
                                        id : data.id,
                                        userid : data.user,
                                        task: data.task,
                                        due: data.due_date,
                                        label: data.label,
                                        completed: data.completed,
                                        created: data.created,
                                    }                     
                                    tasks.push(new_data);  
                                    alert(data.message);
                                    view_tasks(tasks);       
                                },
                                error: function(data){
                                    alert("Server Busy.")
                                    console.log(data);
                                }
                            });
                        });
                    </script>
                    


                    <!-- Completed Modal -->    
                    <div class="modal fade" id="completedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color:#26262D">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Task Completed?</p>       
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-success" id="completed_btn">Yes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    <!-- // Completed Modal -->


                    <div class="col-md-7" style="background-color:#31313A;border-left:1px solid white;">
                        <div class="container" style="margin-top:20px;">
                            <div class="row">
                                <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="add_task">Search</label>                                    
                                            <input class="form-control" type="text" name="task" id="seach_text" onkeyup="searchFun()" placeholder="Search Here">
                                            <i style="float:right;margin-top:-35px;margin-right:10px;" class="fa fa-search"></i>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="add_label">Status</label>                                        
                                        <select name="" id="view_status" class="form-control" onchange="statusFun()">
                                            <option value="all">All</option>
                                            <option value="completed">Completed</option>
                                            <option value="progress">In-Progress</option>                                          
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    function searchFun(){                                        
                                        let search_key = $("#seach_text").val().toLowerCase();
                                        let search_arr = [];
                                        var stat = $("#view_status").val();
                                        
                                        if(stat == "completed"){                                            
                                            for(var i=0;i<tasks.length;i++){
                                                var task_text = tasks[i].task.toLowerCase();
                                                var label_text = tasks[i].label.toLowerCase();
                                                var due_text = "";
                                                var comp_text = tasks[i].completed;                                               
                                                if(tasks[i].due == null){
                                                    due_text = "no due specified";
                                                }else{
                                                    due_text = tasks[i].due.toLowerCase()
                                                }                                                
                                                if((task_text.indexOf(search_key) > -1 || label_text.indexOf(search_key) > -1 || due_text.indexOf(search_key) > -1) && comp_text == 1){
                                                    search_arr.push(tasks[i]);
                                                }
                                            }
                                        }else if(stat == "progress"){                                                
                                            for(var i=0;i<tasks.length;i++){     
                                                var task_text = tasks[i].task.toLowerCase();
                                                var label_text = tasks[i].label.toLowerCase();
                                                var due_text = "";
                                                var comp_text = tasks[i].completed;                                               
                                                if(tasks[i].due == null){
                                                    due_text = "no due specified";
                                                }else{
                                                    due_text = tasks[i].due.toLowerCase()
                                                }                                           
                                                if((task_text.indexOf(search_key) > -1 || label_text.indexOf(search_key) > -1 || due_text.indexOf(search_key) > -1) && comp_text == 0){
                                                    search_arr.push(tasks[i]);
                                                }
                                            }
                                        }else{
                                            for(var i=0;i<tasks.length;i++){  
                                                var task_text = tasks[i].task.toLowerCase();
                                                var label_text = tasks[i].label.toLowerCase();
                                                var due_text = "";
                                                var comp_text = tasks[i].completed;                                               
                                                if(tasks[i].due == null){
                                                    due_text = "no due specified";
                                                }else{
                                                    due_text = tasks[i].due.toLowerCase()
                                                }                                              
                                                if((task_text.indexOf(search_key) > -1 || label_text.indexOf(search_key) > -1 || due_text.indexOf(search_key) > -1)){
                                                    search_arr.push(tasks[i]);
                                                }
                                            }
                                        }
                                        view_tasks(search_arr);
                                    }

                                    function statusFun(){                                                                                
                                        $("#seach_text").val("")
                                        searchFun();
                                    }
                                </script>
                            </div>
                            <div class="row task-view">
                                <div class="col-lg-12" style="margin-top:5px;height:500px;overflow-y:scroll;border-top:1px solid grey;">                                                                           
                                    <div id="task-body">
                                    </div>
                                    <script>                                        
                                        function view_tasks(task_arr){
                                            let string = "";
                                            if(task_arr.length>0){
                                                task_arr.forEach(element => {                                                
                                                string +=
                                                `<div class ="task_complete"><div class='row' style='margin-top:15px;border-left:3px solid purple;padding-top:10px;'>                                        
                                                        <div class='col-10' style='display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;'>`;
                                                        if(element.completed == 1){
                                                            string+= `<p style="color:white;text-overflow:ellipsis;" id="ele_task" class="completed">`+element.task +`</p>`;
                                                        }else{
                                                            if(new Date(element.created).toDateString() == new Date().toDateString()){
                                                                string+= `<p style="color:white;text-overflow:ellipsis;" id="ele_task" onclick="complete_task(`+element.userid+`,`+element.id+`)">`+element.task +`(New)</p>`;
                                                            }else{
                                                                string+= `<p style="color:white;text-overflow:ellipsis;" id="ele_task" onclick="complete_task(`+element.userid+`,`+element.id+`)">`+element.task +`(In Progress)</p>`;
                                                            }
                                                        }                                                    
                                                        string  += `</div>           
                                                        <div class="col-2" style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                            <button id="del" style="" onclick="delete_task(`+element.userid+`,`+element.id+`)"><i class="fa fa-times"></i></button>
                                                        </div>                                        
                                                </div>
                                                <div class="row" style="margin-top:0;border-left:3px solid purple;padding-bottom:10px;">                                        
                                                        <div class="col-10" style="display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">`;                                                
                                                        if(element.due == null){
                                                            string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">No Due Specified (`+element.label.toUpperCase()+`)</p>`;
                                                        }else{
                                                            string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">Due On: `+element.due+` (`+element.label.toUpperCase()+`)</p>`;
                                                        }                                                    
                                                    string +=   `</div>           
                                                        <div class="col-2" style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                            <button id="del" style="" onclick="edit_fun(`+element.userid+`,`+element.id+`,'`+element.task+`','`+element.due+`')"><i class="fa fa-edit"></i></button>
                                                        </div>                                        
                                                </div></div> `;
                                                });
                                                
                                            }else{
                                                string = `<center><p>No Tasks Found.</p></center>`;
                                            }
                                            $("#task-body").html(string);                                            
                                        }

                                        view_tasks(tasks);

                                        function delete_task(userid,id){
                                            // alert(userid+" and " +id);
                                            let result = confirm("Sure you want to delete the task?")                                            
                                            if(result){                                            
                                                $.ajax({
                                                    url: '<?php echo base_url();?>todo/delete',
                                                    type: "POST",
                                                    data : {
                                                        'userid' : userid,
                                                        'id' : id,
                                                    },
                                                    success: function(data){
                                                        data = JSON.parse(data);
                                                        console.log(data)
                                                        if(data.status){
                                                            for(var i=0;i<tasks.length;i++){
                                                                if(tasks[i].id == id){
                                                                    tasks.splice(i,1);
                                                                    view_tasks(tasks);
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    },
                                                    error: function(data){
                                                        console.log(data);
                                                    }
                                                })
                                            }
                                        }

                                        function complete_task(user,id){                                            
                                            $("#completedModal").modal("toggle");
                                            $("#completed_btn").click(function(){
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo base_url();?>todo/Completed",
                                                    data: {
                                                        "id" : id,
                                                        "userid" : user,
                                                    },
                                                    success: function(data){
                                                        data = JSON.parse(data);
                                                        if(data.status == true){
                                                            for(var i=0;i<tasks.length;i++){
                                                                if(tasks[i].id == id){
                                                                    tasks[i].completed = 1;
                                                                }
                                                            }
                                                            view_tasks(tasks);
                                                        }else{
                                                            alert(data.status);
                                                            alert("Server Error")
                                                        }
                                                        $("#completedModal").modal("toggle");
                                                    },
                                                    error: function(data){                                                        
                                                        console.log(data);
                                                        alert("Server Error");
                                                    }
                                                });
                                            });                                            
                                        }
                                    </script>                                                                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color:#26262D">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="task">Task</label>                                    
                <input class="form-control" type="text" name="task" id="task" placeholder="Enter Task">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="password">Due Date</label>
                <input class="form-control" type="date" id="due"  placeholder="Enter Date" >
            </div>
        </div>
        </div>            
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_btn">Save changes</button>
      </div>
    </div>
  </div>
</div>
                <script>                
                    function edit_fun(userid,id,task,due){                                                                                             
                        $("#task").val(task);
                        $("#due").val(due);
                        $("#update_btn").click(function(){                            
                            $.ajax({
                                url : "<?php echo base_url();?>todo/update",
                                type : "POST",
                                data: {
                                    "id": id,
                                    "userid" : userid,
                                    "task" : $("#task").val(),
                                    "due" : $("#due").val(), 
                                },
                                success : function(data){                                                                     
                                    data = JSON.parse(data);                                    
                                    var due ;
                                    if($("#due").val() == ""){
                                        due = null;
                                    }else{
                                        due = $("#due").val();
                                    }
                                    if(data.status){
                                        for(var i=0;i<tasks.length;i++){
                                            if(tasks[i].id == id){
                                                tasks[i].task = $("#task").val();
                                                tasks[i].due = due;
                                                view_tasks(tasks);
                                                $('#exampleModal').modal('toggle');
                                                $("#view_status").val("all");
                                                break;
                                            }
                                        }
                                    }
                                },
                                error: function(data){
                                    alert("Server Error");
                                }
                            });
                        });
                        $('#exampleModal').modal('toggle');                        
                    }                

                    
                </script>                                       
            </div>
        </section>
        <!-- //banner-botttom -->
        <!-- footer -->
        <?php include "footer.php"?>
        <!-- //footer -->
    </body>
</html>
