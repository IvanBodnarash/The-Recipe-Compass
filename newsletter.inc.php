<?php
require 'config.php';
?>

<div class="newsletter-text">
    <h2>Newsletter</h2>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, soluta. Quo saepe earum placeat molestias. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore facilis dolorem tenetur nihil dolor cupiditate</p>
</div>
<div class="newsletter-button">
    <form action="newsletter.inc.php" method="post" class="form-newsletter">
        <div class="textbox-container">
            <input type="email" placeholder="Email Address" name="subs-email" require>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>