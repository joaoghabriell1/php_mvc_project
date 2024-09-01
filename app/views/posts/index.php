<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="m-2">
    <?php flash('post_message') ?>
</div>
<div class="row flex-nowrap justify-content-between">
    <div class="col-md-6 flex-shrink-1 w-auto">
        <h1>Posts</h1>
    </div>
    <div class="w-auto col-md-6 d-flex align-items-center justify-content-end">
        <a href="<?php echo URLROOT ?>posts/add" class="btn btn-primary">
            <i class="fa fa-pencil">Add post</i>
        </a>
    </div>

</div>
<div class="row">
    <?php if ($data['posts_count'] == 0): ?>
        <h2 class="text-muted">You have no posts yet.</h2>
    <?php endif ?>
    <?php foreach ($data['posts'] as $post): ?>
        <div class="card card-body mb-3">
            <h5 class="card-title">
                <?php echo $post->post_title ?>
            </h5>
            <div class="bg-light p-2 mb-3">
                written by <?php echo $post->user_name ?> on <?php echo $post->created_at ?>
            </div>
            <p class="card-text"> <?php echo $post->body; ?> </p>
            <div class="d-flex justify-content-between">
                <div>
                    likes: 0
                </div>
                <div class="d-flex">
                    <form class="mx-2" action="<?php echo URLROOT ?>posts/like/<?php echo $post->post_id ?>/<?php echo $post->user_id ?>" method="post">
                        <input type="submit" class="btn btn-success" value="Like post" class="btn btn-success">
                    </form>
                    <a href="<?php echo URLROOT ?>posts/show/<?php echo $post->post_id ?>" class="btn btn-dark">More</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>