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
        top: -35px;
        left: 50px;
    }

    .edit {
        position: absolute;
        top: -50px;
        left: 370px;
    }

    .delete {
        position: absolute;
        top: -50px;
        left: 270px;
    }
</style>

<div class="container mt-4">


    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h3 class="mt-4 mb-4">My Quotes</h3>
        </div>
        <div class="col-lg-8 mx-auto">
            <?php flash('post_message'); ?>
        </div>
        <?php foreach ($data['posts'] as $post) : ?>
            <div class="col-lg-8 mx-auto">
                <?php flash('post_message'); ?>
            </div>
            <div class="col-lg-8 mx-auto mt-4 mb-4">
                <!-- CUSTOM BLOCKQUOTE -->
                <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded">
                    <div class="blockquote-custom-icon bg-primary shadow-sm"><i class="fa fa-quote-left text-white"></i></div>
                    <p class="mb-0 mt-2 font-italic">"<?php echo $post->body; ?>"</p>
                    <footer class="blockquote-footer pt-4 mt-4 border-top">
                        <cite title="Source Title"><?php echo $post->author; ?></cite>
                    </footer>

                </blockquote><!-- END -->

                <div class="row">

                    <div class="col">
                        <span class="badge badge-primary btn-lg user-created"><i class="fas fa-user-tie"></i> <?php echo $post->name; ?></span>
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->postId; ?>" class="btn btn-lg btn-success edit"><i class="fas fa-pen-nib"></i></i></a>
                    </div>
                    <div class="col">
                        <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->postId; ?>" method="post">
                            <button class="btn btn-lg btn-danger delete" type=" submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="col">
                        <footer class="blockquote-footer pt-2 float-right">
                            <cite title="Source Title"><?php echo $post->postCreated; ?></cite>
                        </footer>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php require APPROOT . '/views/include/footer.php'; ?>