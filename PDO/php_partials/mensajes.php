<?php if (isset($_SESSION['mensaje'])) { ?>
    <div class="alert alert-success alert-dissmissible fade show" style="margin-top:120px;" role="alert">
        <?php
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']) ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <!-- <span aria-hidden="true">&times;</span>
        </button> -->
    </div>
<?php } ?>
<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dissmissible fade show" style="margin-top:120px;" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']) ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
    </div>
<?php } ?>