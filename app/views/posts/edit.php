<?php require APPROOT . '/views/include/header.php'; ?>
<style>
    .blockquote-custom {
        position: relative;
        font-size: 1.1rem;
    }

    .blockquote-custom-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: -25px;
        left: 50px;
    }

    .user-created {
        position: absolute;
        top: 390px;
        left: 50px;
    }
</style>


<div class="row align-self-center mt-4 mb-4 ">
    <div class="col-lg-8 mx-auto">
        <h3 class="mt-4 mb-4">Edit the quote</h3>
    </div>
    <div class="col-lg-8 mx-auto mt-4 mb-4 ">
        <!-- CUSTOM BLOCKQUOTE -->
        <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded mb-4 mt-4">
            <div class="blockquote-custom-icon bg-primary shadow-sm"><i class="fa fa-quote-left text-white"></i></div>
            <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
                <div class="form-group">
                    <label for="body">Quote: </label>
                    <textarea name="body" rows="5" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="author">Author: </label>
                    <input type="text" name="author" class="form-control  <?php echo (!empty($data['author_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['author']; ?>">
                    <span class="invalid-feedback"><?php echo $data['author_err']; ?></span>
                </div>

                <input type="submit" class="btn btn-primary mt-4" value="Update the quote">
            </form>


        </blockquote><!-- END -->

        <a href="<?php echo URLROOT; ?>/posts/myposts" class="btn btn-secondary mt-4 "><i class="fas fa-chevron-left"></i> Back</a>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>