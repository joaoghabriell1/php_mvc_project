<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 flex-shrink-1 w-auto">
        <h2>What's on your mind?</h2>
    </div>
    <form method="post" action="<?php echo URLROOT; ?>posts/add">
        <div class="form-group my-2">
            <label for="title">Title: <sup>*</sup> </label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo !empty($data['title_error']) ? 'is-invalid' : '' ?>">
            <span class="invalid-feedbak">
                <?php echo $data['title_error'] ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="body">Body: <sup>*</sup> </label>
            <textarea name="body" class="form-control <?php echo !empty($data['body_error']) ? 'is-invalid' : '' ?>" id="exampleFormControlTextarea1" rows="3"></textarea>
            <span class="invalid-feedbak">
                <?php echo $data['body_error'] ?>
            </span>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>