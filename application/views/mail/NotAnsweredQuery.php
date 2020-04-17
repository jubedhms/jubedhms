<!DOCTYPE html>
<html lang="en">
<head>
<style>
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>
</head>
<body>
<div>
  <p>Dear Customer Service Team,</p>            
  <p>The system received the user queries which are not in the database. We require your support to answer user queries to improve user experience and satisfaction.

The list of user queries as below: </p>            
  <table class="table table-bordered">
    <thead>
      <tr style="border:1px solid #d3d3d3;">
        <th>User Name</th>
        <th>Date / time</th>
        <th>Queries</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php  if(!empty($data)){ foreach($data as $row){ ?>
      <tr>
        <td style="width:20px;">shushank.kumar@softlogique.com<?php //echo isset($row->query_by_user)?$row->query_by_user:''; ?></td>
        <td><?php echo $row->date_created; ?></td>
        <td><?php echo $row->question; ?></td>
        <td><a href="<?php echo base_url().'chat_manage'; ?>"><p style="color: #00b1f3;">Log in Admin panel</p></a></td>
      </tr>
        <?php } }  ?>
    </tbody>
  </table>
<div class="text-align:center">
  <p>You prompt action is highly appreciated and help to improve Hanh Phuc service.</p>         
  <p></p>   
  Thank You <br>           
  <strong>Hanh Phuc Mobile app system.</strong>           
</div>
</div>

</body>
</html>
