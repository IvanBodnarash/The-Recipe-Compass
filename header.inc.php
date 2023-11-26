<div class="navbar-area" id="stickymenu">
    <div class="main-nav">
        <div class="nav-container">
            <nav class="navbar">
                <a data-goto=".page__section_home" href="index.php" class="navbar-brand">
                    <img src="img/brand-logo-grey.png" alt="logo">
                    <span class="brand-text">The Recipe Compass</span>
                </a>
                <div class="navbar-collapse">
                    <div class="menu-icon">
                        <span></span>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?content=recipes" class="nav-link">Recipes</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?content=newrecipe" class="nav-link">
                                <i class="fas fa-plus"></i>   
                                Add Recipe</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?content=login" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i>   
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?content=logout" class="nav-link">
                                <i class="fa-solid fa-door-open"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <span>
                                <?php
                                session_write_close();
                                session_start();
                                if (isset($_SESSION['valid_recipe_user'])) {
                                    $username = $_SESSION['valid_recipe_user'];
                                    echo "<h3>$username</h3>";
                                }
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>