<?php 
    include '../../common/conn.php';
    $data = mysqli_query($conn,"SELECT * FROM `category` where id = 7");
    $data = mysqli_fetch_array($data);
    $data3 = mysqli_query($conn,"SELECT * FROM `product` where category_id = $data[id] ");
    $data2 = mysqli_query($conn,"SELECT * FROM `order` ");
    include '../../layout/header.php';
    function remove($id){
        include '../../common/conn.php';
        // mysqli_query($conn,"DELETE  FROM `order` WHERE category_id = $id ");
        mysqli_query($conn,"DELETE  FROM `product` WHERE category_id = $id ");
        mysqli_query($conn,"DELETE  FROM `category` WHERE id = $id ");
        header("Location: showCategory.php");
    }
    if (isset($_GET['id'])) {
            remove($_GET['id']);
    }
?>
<tr>

<?php foreach ($data3 as $key => $value) { ?>
<td><?php echo $value["id"] ?></td>
<?php  } ?>

</tr>