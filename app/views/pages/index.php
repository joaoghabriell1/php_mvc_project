<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron jumbontron-fluid">
    <div class="container">
        <h1 class="display-3"> <?php echo $data['title']; ?></h1>
        <p class="lead">
            test
            <?php echo $data['description']; ?>
        </p>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>