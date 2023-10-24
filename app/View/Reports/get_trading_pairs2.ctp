<?php 
//print_r($smenu);exit;
echo "<option value=\"NULL\">-- Select --</option>\n";
foreach ($data as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>