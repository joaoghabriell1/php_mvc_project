<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>
    <?php echo $data['post']->title ?>
</h1>
<?php flash('post_message') ?>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name ?> on <?php echo $data['post']->created_at ?>
</div>
<p>
    <?php echo $data['post']->body ?>
</p>
<?php if ($data['post']->user_id == $_SESSION['user_id']): ?>
    <hr>
    <div class="d-flex justify-content-between">
        <a class="btn btn-dark" href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post']->id ?>">Edit</a>
        <form class="pull-right" action="<?php echo URLROOT ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>