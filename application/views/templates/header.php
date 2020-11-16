<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PubQuiz</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="<?php echo base_url(); ?>assets/script.js"></script>

    <!-- https://stackoverflow.com/questions/12387392/on-click-of-same-button-open-model-and-then-submit-form -->
</head>

<body data-base="http://localhost/pub_quiz/">
    <!-- if the user is logged in the signout button will display -->
    <?php if ($this->session->userdata('logged_in')) : ?>
        <nav>
            <ul class="navbar">
                <li><a href="<?php echo base_url(); ?>users/logout">Sign Out</a></li>
            </ul>
        <?php endif; ?>
        </nav>
        </div>
        <div class="container">
            <!-- flash messages -->
            <?php if ($this->session->flashdata('login_failed')) : ?>
                <?php echo '<p class="alert alert-success">' . $this->session
                    ->flashdata('login_failed') . '</p>'; ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('user_registered')) : ?>
                <?php echo '<p class="alert alert-success">' . $this->session
                    ->flashdata('user_registered') . '</p>'; ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('user_loggedout')) : ?>
                <?php echo '<p class="alert alert-success">' . $this->session
                    ->flashdata('user_loggedout') . '</p>'; ?>
            <?php endif; ?>
        </div>