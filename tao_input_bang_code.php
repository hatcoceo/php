<form method="POST" action="">
    <label>Them so hang</label>
 
 <input type="number" name="n_i"  min="1" max="20" step="1" value="1" ><button type="submit" name="them_hang">nhap</button>
 </form>
 

<?php 
    $n_i =$_POST['n_i'];
 

     for ($i=1; $i <=$n_i ; $i++) { ?>
      <form>
         <label>name</label> <input type="text"><br>
         <label>phone</label> <input type="text"><br><br>
      <?php } ?>
      <button type="submit">gui</button>
      </form>
