<html>
<head>
<link href="form_style.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="jquery.js">
    
</script>
<script type="text/javascript">
function add_row()
{
 $rowno=$("#employee_table tr").length;
 $rowno=$rowno+1;
 $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' name='name[]' placeholder='Enter Name'></td><td><input type='text' name='age[]' placeholder='Enter Age'></td><td><input type='text' name='job[]' placeholder='Enter Job'></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>
</head>
<body>
<div id="wrapper">

<div id="form_div">
 <form method="post" action="store_detail.php">
  <table id="employee_table" align=center>
   <tr id="row1">
    <td><input type="text" name="name[]" placeholder="Enter Name"></td>
    <td><input type="text" name="age[]" placeholder="Enter Age"></td>
    <td><input type="text" name="job[]" placeholder="Enter Job"></td>
   </tr>
  </table>
  <input type="button" onclick="add_row();" value="ADD ROW">
  <input type="submit" name="submit_row" value="SUBMIT">
 </form>
</div>

</div>
</body>
</html>