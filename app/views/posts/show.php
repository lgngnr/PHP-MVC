<?php require APPROOT . "/views/include/header.php"; ?>

<a href="<?php echo URLROOT?>/posts" class="btn btn-light">Back <i class="fa fa-backward"></i></a>
<br>
<h1><?php echo $data['post']->title ?></h1>

<?php require APPROOT . "/views/include/footer.php"; ?>