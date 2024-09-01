<?php

include_once("header.php");




?>

<div class="nav-cell">
        <div class = "query">
                <input type="search" class="query-in" placeholder="Search here" />
                <span id="search-icon" class="fa-solid fa-magnifying-glass"></span>
            </div>
            

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAff1paPzlrfV5tVKgPeCUwD3EL5RcXduY&libraries=places"></script>

<script type="module" src = "js/launch-search.js"></script>

<script src = "js/temp-mostra-tutti-users.js" ></script>

<?php
include_once("footer.php");

?>