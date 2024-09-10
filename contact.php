<?php include('header.php')?>
<!-- header -->

<section class="contact-section section-gaps">
    <div class="container">
        <div class="content-wrap">
            <div class="left-content">
                <div class="image">
                    <img src="./image/contact1.avif" alt="">
                </div>
            </div>
            <div class="right-content">
                <div class="contact-form">
                    <form action="">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="Number">Number</label>
                            <input type="text" name="contact" id="Number" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="message">Subject</label>
                            <textarea id="message" name="message"></textarea>
                        </div>
                        <div class="form-group submit">
                            <input type="submit" value="submit" name="contact-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include('footer.php')?>