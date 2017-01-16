<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Signin Template for Bootstrap</title>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url() ?>assets/css/todo_list_style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

	<body>
    <div class="container">
    	<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
            <div id="myDIV" class="header">
              <h2 style="margin:5px">My To Do List</h2>
              <input type="text" id="todo_task_name" placeholder="Title...">
              <span onclick="newElement()" class="addBtn">Add</span>
            </div>
            <ul id="myUL">
              <?php if($userTodoList){
               foreach($userTodoList as $todoTask){ ?>
                  <li id="<?php echo $todoTask->todo_task_id ?>" class="todo_item <?php echo ($todoTask->todo_task_completed != 0)?'checked':'' ?>"><?php echo $todoTask->todo_task_name ?></li>
              <?php } 
              } ?>
            </ul>
            <div class="row">
              <div class="col-md-4">
                  <span id="itemsLeft">0</span> items left
              </div>
            </div>
        </div>
        <div class="col-md-3"></div>     	
    	</div>
    </div> <!-- /container -->

    <script>
    // Create a "close" button and append it to each list item

    function countItemLeft(){
      var itemLeftCount = $('li.todo_item').length;
      console.log(itemLeftCount);
      $('li.todo_item').each(function(){
        if($(this).hasClass('checked')){
          itemLeftCount--;
        }
      });
      $('#itemsLeft').text(itemLeftCount);      
    }

    $(document).ready(function(){
      countItemLeft();
      $('li.todo_item').each(function(){
        $(this).append("<span class='close'>\u00D7</span>");
      });
    });

    // Click on a close button to hide the current list item
    $('#myUL').on('click','span.close', function(e){
        var listItem = $(this).closest('li');
        $.post("<?php echo base_url() ?>/todo/updateTodoItem", {todo_task_id: $(listItem).attr('id'),todo_task_deleted:'yes'}, function(result){
            var resObj = JSON.parse(result);
            if(resObj.result == 'success'){
              $(listItem).remove();
            } else {
                //show error message
            } 
        });
        countItemLeft();
    });

    // Add a "checked" symbol when clicking on a list item
    $('#myUL').on('click','li.todo_item',function(){
      var checkedChangeToStatus = 'no';
      if($(this).hasClass('checked')){
        checkedChangeToStatus = 'no';
      } else {
        checkedChangeToStatus = 'yes'; 
      }
      var thisEl = this;
      $.post("<?php echo base_url() ?>/todo/updateTodoItem", {todo_task_id: $(this).attr('id'),todo_task_completed:checkedChangeToStatus}, function(result){
          var resObj = JSON.parse(result);
          if(resObj.result == 'success'){
            $(thisEl).toggleClass('checked');
            countItemLeft();
          } else {
              //show error message
          } 
      });
    });

    function newElement() {
      var inputValue = $('#todo_task_name').val();
      if (inputValue === '') {
        alert("You must write something!");
      } else {
        $.post("<?php echo base_url() ?>/todo/addTodoList", {todo_task_name: inputValue}, function(result){
            var resObj = JSON.parse(result);
            if(resObj.result == 'success'){
                var liEl = '<li id="'+resObj.todo_task_id+'" class="todo_item">'
                  + inputValue
                  + "<span class='close'>\u00D7</span>"
                  + '</li>';
                $("#myUL").append(liEl);
            } else {
                //show error message
            } 
        });
      }
      $('#todo_task_name').val('');
      countItemLeft();
    }
    </script>
	</body>
</html>
