<?php

use App\Helper\Template;

?>
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/CookeJason3">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/JasonCooke1988">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                </ul>
                <p><a href="<?= Template::getBasePath() ?>/admin">Page administration</a></p>
                <p class="copyright text-muted">Copyright &copy; Your Website <?= date('Y')?></p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?= Template::assets('/gulp/jquery/jquery.min.js') ?>"></script>
<script src="<?= Template::assets('/gulp/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Custom scripts for this template -->
<script src="<?= Template::assets('/js/clean-blog.min.js') ?>"></script>

</body>

</html>
