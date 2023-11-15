<main class="home-section">
    <div class="search-container">
        <!-- <div class="bg"></div> -->
        <h1>Discover Fantastic Recipes</h1>
        <p>Get the process of making awesome delicious meals for your family and friends</p>
        <div class="search-box">
            <form action="index.php" method="get">
                <div class="input-container">
                    <!-- <label for=""><span>search for recipe:</span></label> -->
                    <input class="search-input" name="searchFor" type="text" placeholder="Search Recipe">
                    <!-- <input name="goButton" type="submit" value="find"> -->
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                    <input name="content" type="hidden" value="search">
                </div>
            </form>
        </div>
    </div>

    <div class="feature">
        <div class="feature-block">
            <div class="feature-item">
                <div class="icon">
                    <i class="far fa-clock"></i>
                </div>
                <div class="text">
                    <h3>Adipisicing elit</h3>
                    <p>Consectetur adipisicing elit. Excepturi incidunt molestias quas expedita</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon">
                    <i class="far fa-user-circle"></i>
                </div>
                <div class="text">
                    <h3>Labore molestiae</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ad ipsum</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon">
                    <i class="fas fa-anchor"></i>
                </div>
                <div class="text">
                    <h3>Labori laborum</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam</p> 
                </div>
            </div>
        </div>
        <div class="feature-desc">
            <h2>Lorem ipsum dolor sit amet</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae quos itaque voluptate alias dolor nulla Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam doloremque tenetur, sed rem similique nihil</p>
        </div>
    </div>

    <div class="latest-recipes-section">
        <h1>The Latest Recipe Posts</h1>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, nobis reiciendis ipsam inventore exercitationem in</p>
        <div class="recipe-container">
            <?php
            include('main.inc.php');
            ?>
        </div>
        <div class="show-all-recipes-block">
            <button class="show-all-recipes-btn"><a href="index.php?content=recipes">All Recipes</a></button>
        </div>
    </div>
</main>